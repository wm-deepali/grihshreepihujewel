@include('admin.top-header')
<div class="main-section">
    @include('admin.header')
    @include('admin.home._styles')

    <div class="app-content content container-fluid">
        <div class="detail-page">

            <div class="detail-page-header">
                <div>
                    <h1>Hero Banners</h1>
                    <div class="crumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a><span>›</span>
                        <a href="{{ route('admin.home-page.index') }}">Manage Home Page</a><span>›</span>
                        Hero Banners
                    </div>
                </div>
                <a href="{{ route('admin.home.banners.create') }}" class="btn-primary-dash"><i class="fa fa-plus"></i> Add Banner</a>
            </div>

            @if (session('success'))
                <div class="ok-box">{{ session('success') }}</div>
            @endif

            <div class="section-card">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th style="width:120px">Image</th>
                            <th>Heading</th>
                            <th style="width:90px">Order</th>
                            <th style="width:110px">Status</th>
                            <th style="width:130px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($banners as $b)
                            <tr id="banner-{{ $b->id }}">
                                <td>
                                    <img src="{{ $b->image_url }}" alt=""
                                        style="width:96px;height:54px;object-fit:cover;border-radius:6px;border:1px solid var(--border)">
                                </td>
                                <td>
                                    <strong>{!! nl2br(e($b->title)) !!}</strong>
                                    @if ($b->eyebrow)
                                        <div style="font-size:12px;color:var(--text-hint);margin-top:2px">{{ $b->eyebrow }}</div>
                                    @endif
                                </td>
                                <td>{{ $b->sort_order }}</td>
                                <td><span class="pill {{ $b->status ? 'pill-on' : 'pill-off' }}">{{ $b->status ? 'Active' : 'Hidden' }}</span></td>
                                <td>
                                    <div class="row-actions">
                                        <a href="{{ route('admin.home.banners.edit', $b->id) }}" class="icon-btn" title="Edit"><i class="fa fa-pencil"></i></a>
                                        <form method="POST" action="{{ route('admin.home.banners.toggle', $b->id) }}">
                                            @csrf
                                            <button type="submit" class="icon-btn" title="{{ $b->status ? 'Hide' : 'Show' }}">
                                                <i class="fa {{ $b->status ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                                            </button>
                                        </form>
                                        <button type="button" class="icon-btn danger" title="Delete" onclick="deleteBanner({{ $b->id }})"><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" style="text-align:center;color:var(--text-hint);padding:32px">No banners yet. Click "Add Banner".</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@include('admin.footer')

<script>
    function deleteBanner(id) {
        if (!confirm('Delete this banner?')) return;

        fetch(@json(url('admin/home/banners')) + '/' + id, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
        })
            .then(r => r.json())
            .then(() => document.getElementById('banner-' + id)?.remove())
            .catch(() => alert('Could not delete. Please try again.'));
    }
</script>