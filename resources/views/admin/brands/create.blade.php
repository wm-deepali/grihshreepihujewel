@include('admin.top-header')

<div class="main-section">
    @include('admin.header')
    @include('admin.brands._styles')

    <div class="app-content content container-fluid">
        <div class="brand-page">

            <div class="page-head">
                <div>
                    <h1>Add Brand</h1>
                    <div class="crumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a><span>›</span>
                        <a href="{{ route('admin.brands.index') }}">Brands</a><span>›</span>Add Brand
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.brands.store') }}" enctype="multipart/form-data">
                @csrf

                @include('admin.brands._form')

                <div class="action-bar">
                    <a href="{{ route('admin.brands.index') }}" class="btn-secondary-dash">Cancel</a>
                    <button type="submit" class="btn-primary-dash"><i class="fa fa-save"></i> Save Brand</button>
                </div>
            </form>

        </div>
    </div>
</div>

@include('admin.footer')