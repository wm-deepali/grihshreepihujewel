@include('admin.top-header')
<div class="main-section">
    @include('admin.header')
    @include('admin.home._styles')

    @php $isEdit = (bool) $banner; @endphp

    <style>
        .hb-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; padding: 20px; }
        .hb-grid .full { grid-column: 1 / -1; }
        .hb-label { display: block; font-size: 12.5px; font-weight: 600; color: var(--text-primary); margin-bottom: 6px; }
        .hb-hint { font-size: 11.5px; color: var(--text-hint); margin-top: 4px; }
        .hb-err { font-size: 12px; color: #c0392b; margin-top: 4px; }
        .hb-grid .field-input { width: 100%; }
        .hb-preview { max-width: 220px; max-height: 124px; object-fit: cover; border-radius: 8px; border: 1px solid var(--border); margin-top: 8px; display: block; }
        .hb-foot { display: flex; gap: 10px; padding: 0 20px 20px; }
        .hb-check { display: inline-flex; align-items: center; gap: 6px; font-size: 13px; }
        @media (max-width: 768px) { .hb-grid { grid-template-columns: 1fr; } }
    </style>

    <div class="app-content content container-fluid">
        <div class="detail-page">

            <div class="detail-page-header">
                <div>
                    <h1>{{ $isEdit ? 'Edit Banner' : 'Add Banner' }}</h1>
                    <div class="crumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a><span>›</span>
                        <a href="{{ route('admin.home-page.index') }}">Manage Home Page</a><span>›</span>
                        <a href="{{ route('admin.home.banners.index') }}">Hero Banners</a><span>›</span>
                        {{ $isEdit ? 'Edit' : 'Add' }}
                    </div>
                </div>
            </div>

            <form method="POST" enctype="multipart/form-data"
                action="{{ $isEdit ? route('admin.home.banners.update', $banner->id) : route('admin.home.banners.store') }}">
                @csrf
                @if ($isEdit) @method('PUT') @endif

                <div class="section-card">
                    <div class="hb-grid">

                        <div class="full">
                            <label class="hb-label">Small heading (above the title)</label>
                            <input type="text" name="eyebrow" class="field-input" maxlength="120"
                                value="{{ old('eyebrow', $banner->eyebrow ?? '') }}" placeholder="Grih Shree & Pihu Jewel">
                            @error('eyebrow')<div class="hb-err">{{ $message }}</div>@enderror
                        </div>

                        <div class="full">
                            <label class="hb-label">Title *</label>
                            <textarea name="title" rows="2" class="field-input" maxlength="200" required
                                placeholder="Beautiful Living.&#10;Timeless Adornment.">{{ old('title', $banner->title ?? '') }}</textarea>
                            <div class="hb-hint">Press Enter to start a new line, as in the design.</div>
                            @error('title')<div class="hb-err">{{ $message }}</div>@enderror
                        </div>

                        <div class="full">
                            <label class="hb-label">Description</label>
                            <textarea name="description" rows="3" class="field-input" maxlength="500">{{ old('description', $banner->description ?? '') }}</textarea>
                            @error('description')<div class="hb-err">{{ $message }}</div>@enderror
                        </div>

                        <div>
                            <label class="hb-label">Banner image {{ $isEdit ? '' : '*' }}</label>
                            <input type="file" name="image" accept="image/*" class="field-input" {{ $isEdit ? '' : 'required' }}
                                onchange="hbPreview(this, 'hbImg')">
                            <div class="hb-hint">Wide image, around 1920 × 800. JPG, PNG or WebP, max 4 MB.</div>
                            @error('image')<div class="hb-err">{{ $message }}</div>@enderror
                            <img id="hbImg" class="hb-preview" alt=""
                                src="{{ $isEdit ? $banner->image_url : '' }}" style="{{ $isEdit ? '' : 'display:none' }}">
                        </div>

                        <div>
                            <label class="hb-label">Mobile image (optional)</label>
                            <input type="file" name="mobile_image" accept="image/*" class="field-input"
                                onchange="hbPreview(this, 'hbMob')">
                            <div class="hb-hint">Taller crop for phones. If empty, the main image is used.</div>
                            @error('mobile_image')<div class="hb-err">{{ $message }}</div>@enderror
                            <img id="hbMob" class="hb-preview" alt=""
                                src="{{ $isEdit ? ($banner->mobile_image_url ?? '') : '' }}"
                                style="{{ $isEdit && $banner->mobile_image ? '' : 'display:none' }}">
                            @if ($isEdit && $banner->mobile_image)
                                <label class="hb-check" style="margin-top:8px">
                                    <input type="checkbox" name="remove_mobile_image" value="1"> Remove mobile image
                                </label>
                            @endif
                        </div>

                        <div>
                            <label class="hb-label">Button 1 text</label>
                            <input type="text" name="button_1_text" class="field-input" maxlength="60"
                                value="{{ old('button_1_text', $banner->button_1_text ?? '') }}" placeholder="Shop Home & Living">
                        </div>
                        <div>
                            <label class="hb-label">Button 1 link</label>
                            <input type="text" name="button_1_url" class="field-input" maxlength="255"
                                value="{{ old('button_1_url', $banner->button_1_url ?? '') }}" placeholder="/products or https://...">
                        </div>

                        <div>
                            <label class="hb-label">Button 2 text (outline)</label>
                            <input type="text" name="button_2_text" class="field-input" maxlength="60"
                                value="{{ old('button_2_text', $banner->button_2_text ?? '') }}" placeholder="Explore Jewellery">
                        </div>
                        <div>
                            <label class="hb-label">Button 2 link</label>
                            <input type="text" name="button_2_url" class="field-input" maxlength="255"
                                value="{{ old('button_2_url', $banner->button_2_url ?? '') }}" placeholder="/products or https://...">
                        </div>

                        <div>
                            <label class="hb-label">Display order</label>
                            <input type="number" name="sort_order" class="field-input" min="0" max="9999"
                                value="{{ old('sort_order', $banner->sort_order ?? 0) }}">
                            <div class="hb-hint">Smaller numbers show first.</div>
                        </div>
                        <div style="display:flex;align-items:flex-end">
                            <label class="hb-check">
                                <input type="checkbox" name="status" value="1"
                                    {{ old('status', $isEdit ? $banner->status : true) ? 'checked' : '' }}> Active (show on website)
                            </label>
                        </div>

                    </div>

                    <div class="hb-foot">
                        <button type="submit" class="btn-primary-dash"><i class="fa fa-save"></i> {{ $isEdit ? 'Update Banner' : 'Save Banner' }}</button>
                        <a href="{{ route('admin.home.banners.index') }}" class="btn-secondary-dash">Cancel</a>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
@include('admin.footer')

<script>
    function hbPreview(input, id) {
        var img = document.getElementById(id);
        if (!input.files || !input.files[0]) return;
        img.src = URL.createObjectURL(input.files[0]);
        img.style.display = 'block';
    }
</script>