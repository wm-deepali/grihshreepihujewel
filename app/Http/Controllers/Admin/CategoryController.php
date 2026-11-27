<?php

namespace App\Http\Controllers\Admin;

use ZipArchive;
use App\Models\Brand;
use App\Models\TaxClass;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Format;
use Illuminate\Validation\Rule;
use App\Imports\CategoryImport;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CategoryController extends Controller
{
    // ✅ List Page
    public function index(Request $request)
    {
        $query = Category::with('parent', 'children', 'brand');

        $brands = Brand::ordered()->get();

        // Parent categories dropdown (narrowed by brand when a brand is selected)
        $parentCategories = Category::whereNull('parent_id')
            ->when($request->filled('brand_id'), fn($q) => $q->where('brand_id', $request->brand_id))
            ->orderBy('name')
            ->get();

        if ($request->filled('brand_id')) {
            $query->where('brand_id', $request->brand_id);
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->type == 'category') {
            $query->whereNull('parent_id');
        } elseif ($request->type == 'subcategory') {
            $query->whereNotNull('parent_id');

            if ($request->filled('category_id')) {
                $query->where('parent_id', $request->category_id);
            }
        }

        $sortBy = $request->get('sort_by', 'id');
        $sortOrder = $request->get('sort_order', 'desc');

        if (in_array($sortBy, ['id', 'name', 'sort_order', 'status', 'is_popular'])) {
            $query->orderBy($sortBy, $sortOrder);
        }

        $categories = $query->paginate(10)->appends($request->all());

        return view('admin.categories.index', compact('categories', 'parentCategories', 'brands'));
    }
    /**
     * Tax classes for the dropdown: active ones, plus the category's current class
     * even if it was deactivated later (so saving the form never silently clears it).
     */
    private function taxClassOptions(?int $currentId = null)
    {
        return TaxClass::where('status', 1)
            ->when($currentId, fn($q) => $q->orWhere('id', $currentId))
            ->orderBy('rate')
            ->get();
    }

    // shared validation
    private function rules(?Category $category = null): array
    {
        return [
            'name' => 'required|string|max:255',
            'size_chart' => 'nullable|string',
            'tax_class_id' => 'nullable|exists:tax_classes,id',

            // parent must be an existing top-level category (max 2 levels) and not itself
            'parent_id' => [
                'nullable',
                Rule::exists('categories', 'id')->whereNull('parent_id')->whereNull('deleted_at'),
                Rule::notIn($category ? [$category->id] : []),
            ],

            // brand is needed only for top-level categories; sub categories inherit it from the parent
            'brand_id' => 'required_without:parent_id|nullable|exists:brands,id',
        ];
    }

    // ✅ Create
    public function create()
    {
        $parents = Category::whereNull('parent_id')->orderBy('name')->get();
        $brands = Brand::active()->ordered()->get();
        $taxClasses = $this->taxClassOptions();

        return view('admin.categories.create', compact('parents', 'brands', 'taxClasses'));
    }


    /**
     * ✅ Compress & store an uploaded image as WebP.
     * Resizes down to max width (keeps aspect ratio, never upscales)
     * and re-encodes as WebP at given quality to shrink file size.
     * Same pattern used for La Pavone product image optimization.
     */
    private function compressAndStore(
        UploadedFile $file,
        string $folder,
        int $maxWidth = 1200,
        int $quality = 80
    ): string {
        $manager = ImageManager::usingDriver(Driver::class);

        $image = $manager->decode($file);

        // Only downscale, never upscale
        if ($image->width() > $maxWidth) {
            $image->scale(width: $maxWidth);
        }

        $encoded = $image->encodeUsingFormat(Format::WEBP, quality: $quality);

        $filename = Str::uuid() . '.webp';
        $path = trim($folder, '/') . '/' . $filename;

        Storage::disk('public')->put($path, (string) $encoded);

        return $path;
    }

    /**
     * Editor-empty check: "<p><br></p>" and similar count as empty,
     * but a table with no text is still kept.
     */
    private function cleanRichText(?string $html): ?string
    {
        $html = trim((string) $html);

        if ($html === '') {
            return null;
        }

        $text = trim(str_replace('&nbsp;', ' ', strip_tags($html)));

        if ($text === '' && !preg_match('/<(table|img)\b/i', $html)) {
            return null;
        }

        return $html;
    }

    // ✅ Store
    public function store(Request $request)
    {
        $request->validate($this->rules());

        $image = null;

        if ($request->hasFile('image')) {
            $image = $this->compressAndStore($request->file('image'), 'categories', 400, 80);
        }

        Category::create([
            'name' => $request->name,
            'sub_title' => $request->sub_title,
            'slug' => $request->slug ? Str::slug($request->slug) : Str::slug($request->name),

            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'image' => $image,
            'size_chart' => $this->cleanRichText($request->size_chart),

            'parent_id' => $request->parent_id ?: null,

            // top-level: chosen brand. Sub category: Category model's saving hook copies the parent's brand.
            'brand_id' => $request->brand_id ?: null,

            'tax_class_id' => $request->tax_class_id ?: null,

            'is_popular' => $request->is_popular ?? 0,
            'is_featured' => $request->is_featured ?? 0,
            'show_in_navbar' => $request->show_in_navbar ?? 0,

            'added_by' => 'admin',
            'status' => $request->status ?? 1,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category Added Successfully');
    }

    // ✅ Edit
    public function edit(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $parents = Category::whereNull('parent_id')
            ->where('id', '!=', $id)
            ->orderBy('name')
            ->get();

        // active brands + the category's current one even if it was deactivated later
        $brands = Brand::where('status', 1)
            ->orWhere('id', $category->brand_id)
            ->ordered()
            ->get();

        $taxClasses = $this->taxClassOptions($category->tax_class_id);
        $redirect = $request->redirect;

        return view('admin.categories.edit', compact('category', 'parents', 'brands', 'taxClasses', 'redirect'));
    }

    // ✅ Update
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate($this->rules($category));

        // a category that already has sub categories cannot become a sub category
        if ($request->filled('parent_id') && $category->children()->exists()) {
            return back()->withInput()->withErrors([
                'parent_id' => 'This category has sub categories, so it cannot be moved under another category.',
            ]);
        }

        $image = $category->image;

        if ($request->hasFile('image')) {
            if ($category->image && Storage::disk('public')->exists($category->image)) {
                Storage::disk('public')->delete($category->image);
            }

            $image = $this->compressAndStore($request->file('image'), 'categories', 400, 80);
        }

        // Changing the brand of a top-level category moves its sub categories and products
        // (handled by the Category model's saved hook).
        $category->update([
            'name' => $request->name,
            'sub_title' => $request->sub_title,
            'slug' => $request->slug ? Str::slug($request->slug) : $category->slug,

            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'image' => $image,
            'size_chart' => $this->cleanRichText($request->size_chart),

            'parent_id' => $request->parent_id ?: null,
            'brand_id' => $request->brand_id ?: $category->brand_id,

            'tax_class_id' => $request->tax_class_id ?: null,

            'is_popular' => $request->is_popular ?? 0,
            'is_featured' => $request->is_featured ?? 0,
            'show_in_navbar' => $request->show_in_navbar ?? 0,

            'status' => $request->status ?? 1,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect($request->redirect ?? route('admin.categories.index'))
            ->with('success', 'Category Updated Successfully');
    }

    // ✅ Delete
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        if ($category->image && Storage::disk('public')->exists($category->image)) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return response()->json([
            'message' => 'Category Deleted Successfully'
        ]);
    }

    public function import()
    {
        return view('admin.categories.import');
    }

    public function importStore(Request $request)
    {
        $request->validate([
            'file' => 'required|mimetypes:text/plain,text/csv,application/vnd.ms-excel'
        ]);

        try {

            Excel::import(
                new CategoryImport,
                $request->file('file')
            );

            return redirect()
                ->route('admin.categories.index')
                ->with('success', 'Categories imported successfully.');

        } catch (\Exception $e) {

            return back()->with(
                'error',
                $e->getMessage()
            );
        }
    }

    public function uploadImagesZip(Request $request)
    {
        $request->validate([
            'zip_file' => 'required|mimes:zip'
        ]);

        try {

            $zip = new ZipArchive();

            if ($zip->open($request->file('zip_file')->getRealPath()) === true) {

                $extractPath = storage_path(
                    'app/public/categories'
                );

                if (!file_exists($extractPath)) {
                    mkdir($extractPath, 0777, true);
                }

                $zip->extractTo($extractPath);

                $zip->close();

                return back()->with(
                    'success',
                    'Category images uploaded successfully.'
                );
            }

            return back()->with(
                'error',
                'Unable to extract ZIP file.'
            );

        } catch (\Exception $e) {

            return back()->with(
                'error',
                $e->getMessage()
            );
        }
    }

    public function downloadParentCategoryReference()
    {
        $categories = Category::whereNull('parent_id')
            ->orWhere('parent_id', 0)
            ->orderBy('id')
            ->get([
                'id',
                'name'
            ]);

        $response = new StreamedResponse(function () use ($categories) {

            $handle = fopen('php://output', 'w');

            fputcsv($handle, [
                'id',
                'category_name'
            ]);

            foreach ($categories as $category) {

                fputcsv($handle, [
                    $category->id,
                    $category->name
                ]);
            }

            fclose($handle);
        });

        $response->headers->set(
            'Content-Type',
            'text/csv'
        );

        $response->headers->set(
            'Content-Disposition',
            'attachment; filename=parent_category_reference.csv'
        );

        return $response;
    }

    public function downloadSample()
    {
        $headers = ['name', 'sub_title', 'image_name', 'brand', 'parent_category', 'meta_title', 'meta_description', 'is_popular', 'is_featured', 'status', 'sort_order'];

        $sampleRow = ['Handloom & Bedding', 'Premium Bedding', 'handloom.jpg', 'grih-shree', '', 'Handloom & Bedding', 'Handloom bedding category', '1', '1', '1', '1'];

        $response = new StreamedResponse(function () use ($headers, $sampleRow) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $headers);
            fputcsv($handle, $sampleRow);
            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename=category_import_sample.csv');

        return $response;
    }

}