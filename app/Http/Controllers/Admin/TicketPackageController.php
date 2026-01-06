<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TicketPackage;
use Illuminate\Http\Request;

class TicketPackageController extends Controller
{
    public function index()
    {
        $packages = TicketPackage::orderBy('created_at', 'desc')->get();
        return view('admin.ticket-packages.index', compact('packages'));
    }

    public function create()
    {
        return view('admin.ticket-packages.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'benefits' => 'nullable|array',
            'quota' => 'required|integer|min:1',
            'is_active' => 'boolean',
            'valid_from' => 'nullable|date',
            'valid_until' => 'nullable|date|after_or_equal:valid_from',
            'is_bundle' => 'boolean',
            'bundle_size' => 'nullable|integer|min:1',
        ]);

        $validated['sold'] = 0;
        $validated['is_active'] = $request->has('is_active');
        $validated['is_bundle'] = $request->has('is_bundle');

        TicketPackage::create($validated);

        return redirect()->route('admin.ticket-packages.index')
            ->with('success', 'Paket tiket berhasil ditambahkan!');
    }

    public function show($id)
    {
        $package = TicketPackage::findOrFail($id);
        return view('admin.ticket-packages.show', compact('package'));
    }

    public function edit($id)
    {
        $package = TicketPackage::findOrFail($id);
        return view('admin.ticket-packages.edit', compact('package'));
    }

    public function update(Request $request, $id)
    {
        $package = TicketPackage::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'benefits' => 'nullable|array',
            'quota' => 'required|integer|min:' . $package->sold,
            'is_active' => 'boolean',
            'valid_from' => 'nullable|date',
            'valid_until' => 'nullable|date|after_or_equal:valid_from',
            'is_bundle' => 'boolean',
            'bundle_size' => 'nullable|integer|min:1',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['is_bundle'] = $request->has('is_bundle');

        $package->update($validated);

        return redirect()->route('admin.ticket-packages.index')
            ->with('success', 'Paket tiket berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $package = TicketPackage::findOrFail($id);

        if ($package->sold > 0) {
            return back()->with('error', 'Tidak dapat menghapus paket yang sudah terjual!');
        }

        $package->delete();

        return redirect()->route('admin.ticket-packages.index')
            ->with('success', 'Paket tiket berhasil dihapus!');
    }
}
