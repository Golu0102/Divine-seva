<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pandit;
use Illuminate\Http\Request;
use App\Models\Pooja;
use Illuminate\Support\Facades\Storage;

class PoojaController extends Controller
{
    // List all poojas
    public function index()
    {
        $poojas = Pooja::latest()->paginate(10);
        return view('admin.poojas.index', compact('poojas'));
    }

    // Show form to create new pooja
    public function create()
    {
        $pandits = Pandit::all();
        return view('admin.poojas.create', compact('pandits'));
    }


    // Store new pooja in DB
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric',
            'pandit_id'   => 'nullable|exists:pandits,id',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only(['name', 'description', 'price', 'pandit_id']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('poojas', 'public');
        }

        Pooja::create($data);

        return redirect()->route('poojas.index')->with('success', 'Pooja added successfully.');
    }

    // Show edit form
    public function edit(Pooja $pooja)
    {
        $pandits = Pandit::all();
        return view('admin.poojas.edit', compact('pooja', 'pandits'));
    }


    // Update existing pooja
    public function update(Request $request, Pooja $pooja)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric',
            'pandit_id'   => 'nullable|exists:pandits,id',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only(['name', 'description', 'price', 'pandit_id']);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($pooja->image && Storage::disk('public')->exists($pooja->image)) {
                Storage::disk('public')->delete($pooja->image);
            }

            $data['image'] = $request->file('image')->store('poojas', 'public');
        }

        $pooja->update($data);

        return redirect()->route('poojas.index')->with('success', 'Pooja updated successfully.');
    }

    // Delete a pooja
    public function destroy(Pooja $pooja)
    {
        if ($pooja->image && Storage::disk('public')->exists($pooja->image)) {
            Storage::disk('public')->delete($pooja->image);
        }

        $pooja->delete();

        return redirect()->route('poojas.index')->with('success', 'Pooja deleted successfully.');
    }
}
