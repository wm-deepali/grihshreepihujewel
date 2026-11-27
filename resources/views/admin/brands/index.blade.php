@include('admin.top-header')

<div class="main-section">
    @include('admin.header')
    @include('admin.brands._styles')

    <div class="app-content content container-fluid">
        <div class="brand-page">

            <div class="page-head">
                <div>
                    <h1>Brands (Menu Groups)</h1>
                    <div class="crumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a><span>›</span>Brands
                    </div>
                </div>
                <a href="{{ route('admin.brands.create') }}" class="btn-primary-dash"><i class="fa fa-plus"></i> Add Brand</a>
            </div>

            @if(session('success'))<div class="alert-box alert-ok">{{ session('success') }}</div>@endif
            @if(session('error'))<div class="alert-box alert-err">{{ session('error') }}</div>@endif

            <form method="GET" class="filter-bar">
                <input type="text" name="search" class="field-input" placeholder="Search brand…" value="{{ request('search') }}">
                <select name="status" class="field-select" onchange="this.form.submit()">
                    <option value="">All status</option>
                    <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Inactive</option>
                </select>
                <button class="btn-secondary-dash" type="submit">Filter</button>
                @if(request()->hasAny(['search', 'status']))
                    <a href="{{ route('admin.brands.index') }}" class="btn-secondary-dash">Reset</a>
                @endif
            </form>

            <div class="table-wrap">
                <table class="brand-table">
                    <thead>
                        <tr>
                            <th>Order</th>
                            <th>Logo</th>
                            <th>Brand</th>
                            <th>Menu Label</th>
                            <th>Categories</th>
                            <th>Products</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($brands as $brand)
                            <tr>
                                <td>{{ $brand->sort_order }}</td>
                                <td>
                                    @if($brand->logo)
                                        <img src="{{ asset('storage/' . $brand->logo) }}" class="brand-logo" alt="{{ $brand->name }}">
                                    @else
                                        <div class="brand-logo-ph"><i class="fa fa-image"></i></div>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $brand->name }}</strong>
                                    <div class="muted">/{{ $brand->slug }}</div>
                                </td>
                                <td>
                                    {{ $brand->menu_label ?: '—' }}
                                    @if($brand->menu_title)<div class="muted">{{ $brand->menu_title }}</div>@endif
                                </td>
                                <td>
                                    {{ $brand->categories_count }}
                                    <div class="muted">{{ max(0, $brand->all_categories_count - $brand->categories_count) }} sub</div>
                                </td>
                                <td>{{ $brand->products_count }}</td>
                                <td>
                                    <span class="badge {{ $brand->status ? 'badge-on' : 'badge-off' }}">
                                        {{ $brand->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="row-actions">
                                        <a href="{{ route('admin.brands.edit', $brand->id) }}" class="icon-btn" title="Edit"><i class="fa fa-pen"></i></a>
                                        <a href="{{ route('admin.categories.index', ['brand_id' => $brand->id]) }}" class="icon-btn" title="View categories"><i class="fa fa-layer-group"></i></a>
                                        <form method="POST" action="{{ route('admin.brands.destroy', $brand->id) }}"
                                            onsubmit="return confirm('Delete this brand?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="icon-btn danger" title="Delete"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="8" class="empty-row">No brands found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div style="margin-top:16px">{{ $brands->links() }}</div>

        </div>
    </div>
</div>

@include('admin.footer')