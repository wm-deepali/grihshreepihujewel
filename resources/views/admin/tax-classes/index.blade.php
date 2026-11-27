@include('admin.top-header')

<div class="main-section">
    @include('admin.header')

    <style>
        :root {
            --bg: #f1f2f4; --surface: #fff; --border: #e3e5e8;
            --text-primary: #202223; --text-secondary: #6d7175; --text-hint: #8c9196;
            --accent: #303d89; --accent-light: #f0f1fc;
            --green: #007a5e; --green-bg: #e3f1ec; --red: #b22222; --red-bg: #fce8e8;
            --amber: #916a00; --amber-bg: #fff5cc;
            --radius-sm: 8px; --radius-md: 12px;
            --shadow-card: 0 1px 3px rgba(0,0,0,.08), 0 0 0 1px var(--border);
            --font: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }
        .tc-page { background: var(--bg); padding: 24px 28px; min-height: 100vh; font-family: var(--font); color: var(--text-primary); }
        .tc-page * { box-sizing: border-box; }
        .page-header { margin-bottom: 24px; }
        .page-header h1 { font-size: 20px; font-weight: 650; margin: 0; }
        .crumb { font-size: 12.5px; color: var(--text-hint); margin-top: 3px; }
        .crumb a { color: var(--accent); text-decoration: none; }
        .crumb span { margin: 0 5px; }

        .tc-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-md); box-shadow: var(--shadow-card); padding: 28px 32px; margin-bottom: 20px; }
        .settings-section-title { font-size: 14px; font-weight: 650; margin: 0 0 4px; display: flex; align-items: center; gap: 8px; }
        .settings-section-title i { color: var(--accent); }
        .settings-section-desc { font-size: 12.5px; color: var(--text-hint); margin: 0 0 18px; }
        .settings-section-desc a { color: var(--accent); }

        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        @media(max-width:640px) { .form-grid { grid-template-columns: 1fr; } .tc-page { padding: 16px; } .tc-card { padding: 20px; } }
        .field-group { display: flex; flex-direction: column; gap: 6px; }
        .field-label { font-size: 12px; font-weight: 600; color: var(--text-secondary); letter-spacing: .03em; text-transform: uppercase; }
        .field-label .req { color: var(--red); margin-left: 2px; }
        .field-hint { font-size: 11.5px; color: var(--text-hint); }
        .field-input { width: 100%; height: 38px; border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 0 12px; font-size: 13.5px; color: var(--text-primary); background: var(--surface); outline: none; font-family: var(--font); transition: border-color .15s, box-shadow .15s; }
        .field-input:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(48,61,137,.12); }

        .toggle-row { display: flex; align-items: center; justify-content: space-between; gap: 12px; padding: 8px 0; }
        .toggle-info-label { font-size: 13px; font-weight: 500; }
        .toggle-info-sub { font-size: 12px; color: var(--text-hint); margin-top: 2px; }
        .toggle-switch { position: relative; width: 38px; height: 22px; flex-shrink: 0; }
        .toggle-switch input { opacity: 0; width: 0; height: 0; }
        .toggle-track { position: absolute; inset: 0; background: var(--border); border-radius: 22px; cursor: pointer; transition: background .2s; }
        .toggle-track::after { content: ''; position: absolute; left: 3px; top: 3px; width: 16px; height: 16px; background: #fff; border-radius: 50%; transition: transform .2s; box-shadow: 0 1px 3px rgba(0,0,0,.2); }
        .toggle-switch input:checked + .toggle-track { background: var(--accent); }
        .toggle-switch input:checked + .toggle-track::after { transform: translateX(16px); }

        .btn-primary-dash, .btn-secondary-dash, .btn-danger-soft { display: inline-flex; align-items: center; gap: 6px; border-radius: var(--radius-sm); padding: 9px 20px; font-size: 13px; cursor: pointer; text-decoration: none !important; font-family: var(--font); }
        .btn-primary-dash { background: var(--accent); color: #fff !important; border: none; font-weight: 600; box-shadow: 0 1px 3px rgba(48,61,137,.25); }
        .btn-primary-dash:hover { background: #252f70; }
        .btn-secondary-dash { background: var(--surface); color: var(--text-primary) !important; border: 1px solid var(--border); font-weight: 500; }
        .btn-secondary-dash:hover { background: var(--bg); }
        .btn-danger-soft { background: var(--red-bg); color: var(--red) !important; border: 1px solid #f5c0c0; font-weight: 600; }
        .btn-danger-soft:hover { background: var(--red); color: #fff !important; }
        .btn-sm { padding: 6px 12px; font-size: 12px; }

        .tc-table-wrap { overflow-x: auto; }
        .tc-table { width: 100%; border-collapse: collapse; font-size: 13px; }
        .tc-table th { text-align: left; font-size: 11.5px; text-transform: uppercase; letter-spacing: .04em; color: var(--text-hint); padding: 10px 12px; border-bottom: 1px solid var(--border); background: #fafafa; }
        .tc-table td { padding: 12px; border-bottom: 1px solid var(--bg); vertical-align: middle; }
        .pill { display: inline-block; padding: 2px 10px; border-radius: 20px; font-size: 11.5px; font-weight: 700; }
        .pill-green { background: var(--green-bg); color: var(--green); }
        .pill-amber { background: var(--amber-bg); color: var(--amber); }
        .pill-grey { background: var(--bg); color: var(--text-secondary); }
        .tc-note { display: flex; gap: 10px; align-items: flex-start; padding: 12px 14px; border-radius: var(--radius-sm); font-size: 13px; margin-bottom: 20px; background: var(--amber-bg); border: 1px solid #f0d060; color: var(--amber); }
    </style>

    <div class="app-content content container-fluid">
        <div class="tc-page">

            <div class="page-header">
                <h1>Tax Classes</h1>
                <div class="crumb">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a><span>›</span>
                    <a href="{{ route('admin.admin-setting.index', ['tab' => 'gst']) }}">Settings</a><span>›</span>
                    Tax Classes
                </div>
            </div>

            @if(!\App\Services\Tax::enabled())
                <div class="tc-note">
                    <i class="fa-solid fa-circle-info"></i>
                    <div>GST is currently <strong>switched off</strong>, so none of these rates are being applied.
                        You can still prepare your classes here. Turn GST on in
                        <a href="{{ route('admin.admin-setting.index', ['tab' => 'gst']) }}">GST &amp; Invoice</a>.</div>
                </div>
            @endif

            {{-- add / edit --}}
            <div class="tc-card">
                <div class="settings-section-title"><i class="fa-solid fa-percent"></i> <span id="tcFormTitle">Add Tax Class</span></div>
                <p class="settings-section-desc">
                    Create one class per GST rate, then assign it to categories (or to a single product if it differs).
                    Anything without a class uses the default class.
                </p>

                <form method="POST" action="{{ route('admin.settings.tax-classes.store') }}" id="taxForm">
                    @csrf
                    <input type="hidden" name="id" id="tcId" value="{{ old('id') }}">
                    <div class="form-grid">
                        <div class="field-group">
                            <label class="field-label">Name <span class="req">*</span></label>
                            <input type="text" name="name" id="tcName" class="field-input" placeholder="e.g. GST 12%"
                                value="{{ old('name') }}" required>
                        </div>
                        <div class="field-group">
                            <label class="field-label">Total GST Rate (%) <span class="req">*</span></label>
                            <input type="number" step="0.01" min="0" max="100" name="rate" id="tcRate" class="field-input"
                                value="{{ old('rate') }}" required>
                            <span class="field-hint">CGST and SGST are half each; IGST is the full rate.</span>
                        </div>
                        <div class="toggle-row">
                            <div>
                                <div class="toggle-info-label">Default class</div>
                                <div class="toggle-info-sub">Used when a product and its category have no class.</div>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" name="is_default" id="tcDefault" value="1" {{ old('is_default') ? 'checked' : '' }}>
                                <span class="toggle-track"></span>
                            </label>
                        </div>
                        <div class="toggle-row">
                            <div><div class="toggle-info-label">Active</div></div>
                            <label class="toggle-switch">
                                <input type="checkbox" name="status" id="tcStatus" value="1" {{ old('name') ? (old('status') ? 'checked' : '') : 'checked' }}>
                                <span class="toggle-track"></span>
                            </label>
                        </div>
                    </div>
                    <div style="margin-top:18px;display:flex;gap:10px">
                        <button type="submit" class="btn-primary-dash"><i class="fa fa-save"></i> Save Tax Class</button>
                        <button type="button" class="btn-secondary-dash" onclick="resetTaxForm()">Clear</button>
                    </div>
                </form>
            </div>

            {{-- list --}}
            <div class="tc-card">
                <div class="settings-section-title"><i class="fa-solid fa-list"></i> All Tax Classes</div>
                <p class="settings-section-desc">The default class cannot be deleted. Make another class the default first.</p>

                <div class="tc-table-wrap">
                    <table class="tc-table">
                        <thead>
                            <tr>
                                <th>Name</th><th>Rate</th><th>Categories</th><th>Products</th><th>Status</th><th style="width:150px"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($taxClasses as $tc)
                                <tr>
                                    <td>
                                        {{ $tc->name }}
                                        @if($tc->is_default) <span class="pill pill-green">Default</span> @endif
                                    </td>
                                    <td>{{ rtrim(rtrim(number_format($tc->rate, 2), '0'), '.') }}%</td>
                                    <td>{{ $tc->categories_count }}</td>
                                    <td>{{ $tc->products_count }}</td>
                                    <td>
                                        <span class="pill {{ $tc->status ? 'pill-green' : 'pill-grey' }}">
                                            {{ $tc->status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td style="white-space:nowrap">
                                        <button type="button" class="btn-secondary-dash btn-sm js-edit-tc"
                                            data-id="{{ $tc->id }}" data-name="{{ $tc->name }}" data-rate="{{ $tc->rate }}"
                                            data-default="{{ $tc->is_default ? 1 : 0 }}" data-status="{{ $tc->status ? 1 : 0 }}">
                                            <i class="fa-solid fa-pen"></i> Edit
                                        </button>
                                        @unless($tc->is_default)
                                            <form method="POST" action="{{ route('admin.settings.tax-classes.destroy', $tc) }}"
                                                style="display:inline" onsubmit="return confirm('Delete this tax class?')">
                                                @csrf @method('DELETE')
                                                <button class="btn-danger-soft btn-sm"><i class="fa-solid fa-trash"></i></button>
                                            </form>
                                        @endunless
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="6" style="text-align:center;color:var(--text-hint)">No tax classes yet.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

@include('admin.footer')

<script>
    function resetTaxForm() {
        document.getElementById('taxForm').reset();
        document.getElementById('tcId').value = '';
        document.getElementById('tcName').value = '';
        document.getElementById('tcRate').value = '';
        document.getElementById('tcDefault').checked = false;
        document.getElementById('tcStatus').checked = true;
        document.getElementById('tcFormTitle').textContent = 'Add Tax Class';
    }

    document.querySelectorAll('.js-edit-tc').forEach(function (b) {
        b.addEventListener('click', function () {
            document.getElementById('tcId').value = b.dataset.id;
            document.getElementById('tcName').value = b.dataset.name;
            document.getElementById('tcRate').value = b.dataset.rate;
            document.getElementById('tcDefault').checked = b.dataset.default === '1';
            document.getElementById('tcStatus').checked = b.dataset.status === '1';
            document.getElementById('tcFormTitle').textContent = 'Edit Tax Class';
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    });
</script>