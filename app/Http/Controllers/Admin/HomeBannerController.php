<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeBannerController extends Controller
{
    public function index()
    {
        $banners = HomeBanner::ordered()->get();

        return view('admin.home.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.home.banners.form', ['banner' => null]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request, true);

        $data['image'] = $request->file('image')->store('home-banners', 'public');

        if ($request->hasFile('mobile_image')) {
            $data['mobile_image'] = $request->file('mobile_image')->store('home-banners', 'public');
        }

        HomeBanner::create($data);

        return redirect()->route('admin.home.banners.index')->with('success', 'Banner added.');
    }

    public function edit(HomeBanner $banner)
    {
        return view('admin.home.banners.form', compact('banner'));
    }

    public function update(Request $request, HomeBanner $banner)
    {
        $data = $this->validated($request, false);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($banner->image);
            $data['image'] = $request->file('image')->store('home-banners', 'public');
        }

        if ($request->hasFile('mobile_image')) {
            if ($banner->mobile_image) {
                Storage::disk('public')->delete($banner->mobile_image);
            }
            $data['mobile_image'] = $request->file('mobile_image')->store('home-banners', 'public');
        } elseif ($request->boolean('remove_mobile_image') && $banner->mobile_image) {
            Storage::disk('public')->delete($banner->mobile_image);
            $data['mobile_image'] = null;
        }

        $banner->update($data);

        return redirect()->route('admin.home.banners.index')->with('success', 'Banner updated.');
    }

    public function toggle(HomeBanner $banner)
    {
        $banner->update(['status' => !$banner->status]);

        return back()->with('success', 'Banner ' . ($banner->status ? 'activated.' : 'hidden.'));
    }

    public function destroy(HomeBanner $banner)
    {
        $banner->delete();

        return response()->json(['status' => true]);
    }

    private function validated(Request $request, bool $isNew): array
    {
        $data = $request->validate([
            'eyebrow'       => 'nullable|string|max:120',
            'title'         => 'required|string|max:200',
            'description'   => 'nullable|string|max:500',
            'image'         => ($isNew ? 'required' : 'nullable') . '|image|mimes:jpg,jpeg,png,webp|max:4096',
            'mobile_image'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'button_1_text' => 'nullable|string|max:60',
            'button_1_url'  => 'nullable|string|max:255',
            'button_2_text' => 'nullable|string|max:60',
            'button_2_url'  => 'nullable|string|max:255',
            'sort_order'    => 'nullable|integer|min:0|max:9999',
        ]);

        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);
        $data['status'] = $request->boolean('status');

        // files are handled by store()/update(), never mass-assigned from the request
        unset($data['image'], $data['mobile_image']);

        return $data;
    }
}