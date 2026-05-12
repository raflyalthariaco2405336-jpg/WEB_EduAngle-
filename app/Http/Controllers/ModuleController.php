<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;
use App\Models\Module;

class ModuleController extends Controller
{
    public function publicIndex()
    {
        $modules = Module::all();
        return view('materi', compact('modules'));
    }

    public function publicShow(Module $module)
    {
        return view('materi_show', compact('module'));
    }

    public function index()
    {
        $modules = Module::all();
        return view('admin.modules.index', compact('modules'));
    }

    public function create()
    {
        return view('admin.modules.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('aset/modules'), $imageName);
            $validated['image_path'] = 'aset/modules/' . $imageName;
        }

        Module::create($validated);

        return redirect()->route('dashboard.modules.index')->with('success', 'Module created successfully.');
    }

    public function edit(Module $module)
    {
        return view('admin.modules.edit', compact('module'));
    }

    public function update(Request $request, Module $module)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($module->image_path && File::exists(public_path($module->image_path))) {
                File::delete(public_path($module->image_path));
            }
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('aset/modules'), $imageName);
            $validated['image_path'] = 'aset/modules/' . $imageName;
        }

        $module->update($validated);

        return redirect()->route('dashboard.modules.index')->with('success', 'Module updated successfully.');
    }

    public function destroy(Module $module)
    {
        if ($module->image_path && File::exists(public_path($module->image_path))) {
            File::delete(public_path($module->image_path));
        }
        $module->delete();

        return redirect()->route('dashboard.modules.index')->with('success', 'Module deleted successfully.');
    }
}
