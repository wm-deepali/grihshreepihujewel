<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Tax;
use App\Models\TaxClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaxClassController extends Controller
{
    public function index()
    {
        $taxClasses = TaxClass::withCount(['categories', 'products'])
            ->orderByDesc('is_default')
            ->orderBy('rate')
            ->get();

        return view('admin.tax-classes.index', compact('taxClasses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id' => 'nullable|exists:tax_classes,id',
            'name' => 'required|string|max:100',
            'rate' => 'required|numeric|min:0|max:100',
        ]);

        $existing = !empty($validated['id']) ? TaxClass::find($validated['id']) : null;

        $data = [
            'name' => $validated['name'],
            'rate' => $validated['rate'],
            'is_default' => $request->boolean('is_default'),
            'status' => $request->boolean('status'),
        ];

        // the default class must always stay active and cannot be un-defaulted from here
        // (make another class the default instead)
        if ($existing && $existing->is_default) {
            $data['is_default'] = true;
            $data['status'] = true;
        }

        // a default class must be active
        if ($data['is_default']) {
            $data['status'] = true;
        }

        DB::transaction(function () use ($existing, $data) {
            if ($data['is_default']) {
                TaxClass::query()->update(['is_default' => false]);
            }

            $class = $existing ?? new TaxClass();
            $class->fill($data)->save();

            // first class ever created becomes the default
            if (!TaxClass::where('is_default', true)->exists()) {
                $class->update(['is_default' => true, 'status' => true]);
            }
        });

        Tax::flush();
        return redirect()
            ->route('admin.settings.tax-classes.index')
            ->with('success', 'Tax class saved successfully.');
    }

    public function destroy(TaxClass $taxClass)
    {
        if ($taxClass->is_default) {
            return back()->with('error', 'This is the default tax class. Make another class the default first.');
        }

        // categories and products pointing here fall back to the default (nullOnDelete)
        $taxClass->delete();
        Tax::flush();
        return redirect()
            ->route('admin.settings.tax-classes.index')
            ->with('success', 'Tax class deleted. Items that used it now use the default class.');
    }
}