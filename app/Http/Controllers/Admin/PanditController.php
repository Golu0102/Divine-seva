<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pandit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PanditController extends Controller
{
    public function index()
    {
        $pandits = Pandit::latest()->paginate(10);
        return view('admin.pandits.index', compact('pandits'));
    }

    public function create()
    {
        return view('admin.pandits.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'experience' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only(['name', 'experience', 'bio']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('pandits', 'public');
        }

        Pandit::create($data);

        return redirect()->route('pandits.index')->with('success', 'Pandit added successfully.');
    }

    public function edit(Pandit $pandit)
    {
        return view('admin.pandits.edit', compact('pandit'));
    }

    public function update(Request $request, Pandit $pandit)
    {
        $request->validate([
            'name' => 'required',
            'experience' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only(['name', 'experience', 'bio']);

        if ($request->hasFile('image')) {
            if ($pandit->image && Storage::disk('public')->exists($pandit->image)) {
                Storage::disk('public')->delete($pandit->image);
            }

            $data['image'] = $request->file('image')->store('pandits', 'public');
        }

        $pandit->update($data);

        return redirect()->route('pandits.index')->with('success', 'Pandit updated successfully.');
    }

    public function destroy(Pandit $pandit)
    {
        if ($pandit->image && Storage::disk('public')->exists($pandit->image)) {
            Storage::disk('public')->delete($pandit->image);
        }

        $pandit->delete();

        return redirect()->route('pandits.index')->with('success', 'Pandit deleted successfully.');
    }
}
