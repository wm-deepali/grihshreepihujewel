<style>
    :root {
        --bg: #f1f2f4; --surface: #fff; --border: #e3e5e8;
        --text-primary: #202223; --text-secondary: #6d7175; --text-hint: #8c9196;
        --accent: #303d89; --accent-light: #f0f1fc;
        --green: #007a5e; --green-bg: #e3f1ec; --red: #b22222; --red-bg: #fce8e8;
        --radius-sm: 8px; --radius-md: 12px;
        --shadow-card: 0 1px 3px rgba(0,0,0,.08), 0 0 0 1px var(--border);
        --font: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    }
    .brand-page { background: var(--bg); padding: 24px 28px; min-height: 100vh; font-family: var(--font); color: var(--text-primary); }
    .brand-page * { box-sizing: border-box; }
    .page-head { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px; margin-bottom: 20px; }
    .page-head h1 { font-size: 20px; font-weight: 650; margin: 0; }
    .crumb { font-size: 12.5px; color: var(--text-hint); margin-top: 3px; }
    .crumb a { color: var(--accent); text-decoration: none; }
    .crumb span { margin: 0 5px; }

    .btn-primary-dash, .btn-secondary-dash {
        display: inline-flex; align-items: center; gap: 6px; border-radius: var(--radius-sm);
        padding: 8px 18px; font-size: 13px; font-weight: 600; cursor: pointer;
        text-decoration: none !important; font-family: var(--font);
    }
    .btn-primary-dash { background: var(--accent); color: #fff !important; border: none; box-shadow: 0 1px 3px rgba(48,61,137,.25); }
    .btn-primary-dash:hover { background: #252f70; }
    .btn-secondary-dash { background: var(--surface); color: var(--text-primary) !important; border: 1px solid var(--border); font-weight: 500; }
    .btn-secondary-dash:hover { background: var(--bg); }

    .create-layout { display: grid; grid-template-columns: 1fr 320px; gap: 20px; align-items: start; }
    @media(max-width:900px) { .create-layout { grid-template-columns: 1fr; } .brand-page { padding: 16px; } }

    .section-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-md); box-shadow: var(--shadow-card); overflow: hidden; margin-bottom: 16px; }
    .section-card-header { padding: 14px 20px; border-bottom: 1px solid var(--border); background: #fafafa; }
    .section-card-header h5 { font-size: 13px; font-weight: 650; margin: 0; }
    .section-card-body { padding: 20px; }

    .field-group { margin-bottom: 16px; }
    .field-group:last-child { margin-bottom: 0; }
    .field-label { display: block; font-size: 12px; font-weight: 600; color: var(--text-secondary); letter-spacing: .03em; text-transform: uppercase; margin-bottom: 6px; }
    .field-label .req { color: var(--red); margin-left: 2px; }
    .field-input, .field-select {
        width: 100%; height: 38px; border: 1px solid var(--border); border-radius: var(--radius-sm);
        padding: 0 12px; font-size: 13.5px; color: var(--text-primary); background: var(--surface);
        outline: none; font-family: var(--font); transition: border-color .15s, box-shadow .15s;
    }
    .field-input:focus, .field-select:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(48,61,137,.12); }
    .field-hint { font-size: 11.5px; color: var(--text-hint); margin-top: 4px; }
    .field-error { font-size: 11.5px; color: var(--red); margin-top: 4px; }

    .slug-wrap { position: relative; }
    .slug-prefix { position: absolute; left: 0; top: 0; bottom: 0; display: flex; align-items: center; padding: 0 10px; background: var(--bg); border: 1px solid var(--border); border-right: none; border-radius: var(--radius-sm) 0 0 var(--radius-sm); font-size: 12px; color: var(--text-hint); pointer-events: none; }
    .slug-input { padding-left: 74px !important; }

    .upload-current { display: flex; align-items: center; gap: 12px; border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 10px; background: var(--bg); margin-bottom: 12px; }
    .upload-current img, .upload-preview img { max-width: 100%; max-height: 90px; object-fit: contain; border-radius: 6px; }
    .upload-preview { display: none; margin-top: 10px; text-align: center; }
    .file-upload-area { border: 2px dashed var(--border); border-radius: var(--radius-md); padding: 20px; text-align: center; position: relative; transition: border-color .15s, background .15s; }
    .file-upload-area:hover { border-color: var(--accent); background: var(--accent-light); }
    .file-upload-area input[type=file] { position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%; }
    .file-upload-area p { font-size: 13px; color: var(--text-secondary); margin: 0; }
    .file-upload-area small { font-size: 11.5px; color: var(--text-hint); }

    .action-bar { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-md); box-shadow: var(--shadow-card); padding: 14px 20px; display: flex; justify-content: flex-end; gap: 10px; margin-top: 20px; }

    /* index */
    .alert-box { border-radius: var(--radius-sm); padding: 10px 14px; font-size: 13px; margin-bottom: 14px; }
    .alert-ok { background: var(--green-bg); color: var(--green); }
    .alert-err { background: var(--red-bg); color: var(--red); }
    .filter-bar { display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 14px; }
    .filter-bar .field-input, .filter-bar .field-select { width: auto; min-width: 180px; }
    .table-wrap { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-md); box-shadow: var(--shadow-card); overflow-x: auto; }
    .brand-table { width: 100%; border-collapse: collapse; font-size: 13px; }
    .brand-table th { text-align: left; padding: 12px 16px; background: #fafafa; border-bottom: 1px solid var(--border); font-size: 11.5px; text-transform: uppercase; letter-spacing: .04em; color: var(--text-secondary); white-space: nowrap; }
    .brand-table td { padding: 12px 16px; border-bottom: 1px solid var(--bg); vertical-align: middle; }
    .brand-table tr:last-child td { border-bottom: none; }
    .brand-logo { width: 44px; height: 44px; object-fit: contain; border: 1px solid var(--border); border-radius: 8px; background: #fff; }
    .brand-logo-ph { width: 44px; height: 44px; border: 1px solid var(--border); border-radius: 8px; background: var(--bg); display: flex; align-items: center; justify-content: center; color: var(--text-hint); }
    .badge { display: inline-block; padding: 3px 10px; border-radius: 20px; font-size: 11.5px; font-weight: 600; }
    .badge-on { background: var(--green-bg); color: var(--green); }
    .badge-off { background: var(--red-bg); color: var(--red); }
    .muted { color: var(--text-hint); font-size: 12px; }
    .row-actions { display: flex; gap: 8px; }
    .icon-btn { width: 32px; height: 32px; border: 1px solid var(--border); border-radius: 8px; background: #fff; display: inline-flex; align-items: center; justify-content: center; color: var(--text-secondary); cursor: pointer; text-decoration: none !important; }
    .icon-btn:hover { background: var(--bg); }
    .icon-btn.danger { color: var(--red); }
    .empty-row { text-align: center; padding: 40px 16px !important; color: var(--text-hint); }
</style>