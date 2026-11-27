<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Format;
use Intervention\Image\ImageManager;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        $brands = Brand::withCount(['categories', 'allCategories', 'products'])
            ->when($request->filled('search'), fn($q) => $q->where('name', 'like', '%' . $request->search . '%'))
            ->when($request->filled('status'), fn($q) => $q->where('status', $request->status))
            ->ordered()
            ->paginate(10)
            ->appends($request->all());

        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    private function rules(?Brand $brand = null): array
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('brands', 'slug')->ignore($brand?->id)],
            'menu_label' => 'nullable|string|max:100',
            'menu_title' => 'nullable|string|max:150',
            'feature_title' => 'nullable|string|max:150',
            'sort_order' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
            'logo' => 'nullable|image|max:2048',
            'feature_image' => 'nullable|image|max:2048',
        ];
    }

    public function store(Request $request)
    {
        $request->validate($this->rules());

        $slug = Str::slug($request->slug ?: $request->name);

        if (Brand::where('slug', $slug)->exists()) {
            return back()->withInput()->withErrors(['slug' => 'This slug is already used by another brand.']);
        }

        Brand::create([
            'name' => $request->name,
            'slug' => $slug,
            'menu_label' => $request->menu_label,
            'menu_title' => $request->menu_title,
            'feature_title' => $request->feature_title,
            'sort_order' => $request->sort_order ?? 0,
            'status' => $request->status ?? 1,
            'logo' => $request->hasFile('logo')
                ? $this->compressAndStore($request->file('logo'), 'brands', 400, 85) : null,
            'feature_image' => $request->hasFile('feature_image')
                ? $this->compressAndStore($request->file('feature_image'), 'brands', 900, 80) : null,
        ]);

        return redirect()->route('admin.brands.index')->with('success', 'Brand added successfully.');
    }

    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $request->validate($this->rules($brand));

        $slug = Str::slug($request->slug ?: $request->name);

        if (Brand::where('slug', $slug)->where('id', '!=', $brand->id)->exists()) {
            return back()->withInput()->withErrors(['slug' => 'This slug is already used by another brand.']);
        }

        $data = [
            'name' => $request->name,
            'slug' => $slug,
            'menu_label' => $request->menu_label,
            'menu_title' => $request->menu_title,
            'feature_title' => $request->feature_title,
            'sort_order' => $request->sort_order ?? 0,
            'status' => $request->status ?? 1,
        ];

        if ($request->hasFile('logo')) {
            $this->deleteFile($brand->logo);
            $data['logo'] = $this->compressAndStore($request->file('logo'), 'brands', 400, 85);
        }

        if ($request->hasFile('feature_image')) {
            $this->deleteFile($brand->feature_image);
            $data['feature_image'] = $this->compressAndStore($request->file('feature_image'), 'brands', 900, 80);
        }

        $brand->update($data);

        return redirect()->route('admin.brands.index')->with('success', 'Brand updated successfully.');
    }

    public function destroy(Brand $brand)
    {
        if ($brand->allCategories()->exists() || $brand->products()->exists()) {
            return back()->with('error', 'This brand still has categories or products. Move them to another brand first.');
        }

        $this->deleteFile($brand->logo);
        $this->deleteFile($brand->feature_image);

        $brand->delete();

        return redirect()->route('admin.brands.index')->with('success', 'Brand deleted successfully.');
    }

    private function deleteFile(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    // same WebP compression used in CategoryController
    private function compressAndStore(UploadedFile $file, string $folder, int $maxWidth = 900, int $quality = 80): string
    {
        $manager = ImageManager::usingDriver(Driver::class);
        $image = $manager->decode($file);

        if ($image->width() > $maxWidth) {
            $image->scale(width: $maxWidth);
        }

        $encoded = $image->encodeUsingFormat(Format::WEBP, quality: $quality);

        $path = trim($folder, '/') . '/' . Str::uuid() . '.webp';
        Storage::disk('public')->put($path, (string) $encoded);

        return $path;
    }
}