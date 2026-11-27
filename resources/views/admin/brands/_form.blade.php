@php $brand = $brand ?? new \App\Models\Brand; @endphp

<div class="create-layout">

    <!-- LEFT -->
    <div>
        <div class="section-card">
            <div class="section-card-header"><h5>Brand Information</h5></div>
            <div class="section-card-body">

                <div class="field-group">
                    <label class="field-label">Brand Name <span class="req">*</span></label>
                    <input type="text" name="name" id="name" class="field-input" required
                        value="{{ old('name', $brand->name) }}" placeholder="e.g. Grih Shree">
                    @error('name')<div class="field-error">{{ $message }}</div>@enderror
                </div>

                <div class="field-group">
                    <label class="field-label">Slug</label>
                    <div class="slug-wrap">
                        <span class="slug-prefix">/brand/</span>
                        <input type="text" name="slug" id="slug" class="field-input slug-input"
                            value="{{ old('slug', $brand->slug) }}" placeholder="auto-generated">
                    </div>
                    @error('slug')<div class="field-error">{{ $message }}</div>@enderror
                </div>

                <div class="field-group">
                    <label class="field-label">Sort Order</label>
                    <input type="number" min="0" name="sort_order" class="field-input" style="max-width:120px"
                        value="{{ old('sort_order', $brand->sort_order ?? 0) }}">
                    <div class="field-hint">Lower numbers appear first in the menu.</div>
                </div>
            </div>
        </div>

        <div class="section-card">
            <div class="section-card-header"><h5>Menu Display (Storefront)</h5></div>
            <div class="section-card-body">

                <div class="field-group">
                    <label class="field-label">Menu Label</label>
                    <input type="text" name="menu_label" class="field-input"
                        value="{{ old('menu_label', $brand->menu_label) }}" placeholder="e.g. Jewellery">
                    <div class="field-hint">Text shown in the top navigation. Falls back to the brand name.</div>
                    @error('menu_label')<div class="field-error">{{ $message }}</div>@enderror
                </div>

                <div class="field-group">
                    <label class="field-label">Menu Title</label>
                    <input type="text" name="menu_title" class="field-input"
                        value="{{ old('menu_title', $brand->menu_title) }}" placeholder="e.g. Jewellery & Accessories">
                    <div class="field-hint">Heading inside the mega menu, and the group name in the admin category forms.</div>
                    @error('menu_title')<div class="field-error">{{ $message }}</div>@enderror
                </div>

                <div class="field-group">
                    <label class="field-label">Feature Caption</label>
                    <input type="text" name="feature_title" class="field-input"
                        value="{{ old('feature_title', $brand->feature_title) }}" placeholder="e.g. Timeless Adornment">
                    <div class="field-hint">Caption on the side image of the mega menu.</div>
                    @error('feature_title')<div class="field-error">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>
    </div>

    <!-- RIGHT -->
    <div>
        <div class="section-card">
            <div class="section-card-header"><h5>Logo</h5></div>
            <div class="section-card-body">
                @if($brand->logo)
                    <div class="upload-current" data-current="logo">
                        <img src="{{ asset('storage/' . $brand->logo) }}" alt="Logo">
                        <span class="muted">Current logo. Upload a new file to replace it.</span>
                    </div>
                @endif
                <div class="file-upload-area">
                    <input type="file" name="logo" accept="image/*" data-preview="logoPreview">
                    <p>{{ $brand->logo ? 'Replace logo' : 'Upload logo' }}</p>
                    <small>PNG, JPG, WEBP, max 2 MB</small>
                </div>
                <div class="upload-preview" id="logoPreview"><img src="" alt="Logo preview"></div>
                @error('logo')<div class="field-error">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="section-card">
            <div class="section-card-header"><h5>Mega Menu Image</h5></div>
            <div class="section-card-body">
                @if($brand->feature_image)
                    <div class="upload-current">
                        <img src="{{ asset('storage/' . $brand->feature_image) }}" alt="Feature image">
                        <span class="muted">Current image. Upload a new file to replace it.</span>
                    </div>
                @endif
                <div class="file-upload-area">
                    <input type="file" name="feature_image" accept="image/*" data-preview="featurePreview">
                    <p>{{ $brand->feature_image ? 'Replace image' : 'Upload image' }}</p>
                    <small>Shown on the right side of this brand's mega menu</small>
                </div>
                <div class="upload-preview" id="featurePreview"><img src="" alt="Preview"></div>
                @error('feature_image')<div class="field-error">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="section-card">
            <div class="section-card-header"><h5>Status</h5></div>
            <div class="section-card-body">
                <select name="status" class="field-select">
                    <option value="1" {{ old('status', $brand->status ?? 1) ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ !old('status', $brand->status ?? 1) ? 'selected' : '' }}>Inactive</option>
                </select>
                <div class="field-hint">Inactive brands disappear from the storefront menu.</div>
            </div>
        </div>
    </div>
</div>

<script>
    (function () {
        // slug auto-fill (only while the slug is empty / untouched)
        const name = document.getElementById('name');
        const slug = document.getElementById('slug');
        let manual = slug.value.trim() !== '';
        slug.addEventListener('input', () => manual = true);
        name.addEventListener('input', () => {
            if (manual) return;
            slug.value = name.value.toLowerCase().trim().replace(/&/g, 'and')
                .replace(/\s+/g, '-').replace(/[^\w-]+/g, '');
        });

        // image previews
        document.querySelectorAll('input[type=file][data-preview]').forEach(input => {
            input.addEventListener('change', () => {
                const box = document.getElementById(input.dataset.preview);
                const file = input.files[0];
                if (!file) { box.style.display = 'none'; return; }
                const r = new FileReader();
                r.onload = e => { box.querySelector('img').src = e.target.result; box.style.display = 'block'; };
                r.readAsDataURL(file);
            });
        });
    })();
</script>