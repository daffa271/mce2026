<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use Illuminate\Http\Request;

class CampusController extends Controller
{
    public function index()
    {
        $campuses = Campus::all();
        return view('campuses.index', compact('campuses'));
    }

    public function create()
    {
        return view('campus.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'description' => 'nullable|string',
        ]);

        Campus::create($request->all());

        return redirect()->route('campuses.index')->with('success', 'Kampus berhasil ditambahkan.');
    }

    public function edit(Campus $campus)
    {
        return view('campus.edit', compact('campus'));
    }

    public function update(Request $request, Campus $campus)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $campus->update($request->all());

        return redirect()->route('campuses.index')->with('success', 'Data kampus diperbarui.');
    }

    public function destroy(Campus $campus)
    {
        $campus->delete();
        return back()->with('success', 'Data kampus dihapus.');
    }
}
