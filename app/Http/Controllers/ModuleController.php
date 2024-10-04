<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Module::query();

        if ($request->has('search')) {
            $search = strtolower($request->input('search'));
            $query->whereRaw('LOWER(name) like ?', ["%{$search}%"])
                ->orWhereRaw('LOWER(code) like ?', ["%{$search}%"]);

        }

        $modules = $query->select('id', 'code', 'name', 'semester', 'credit', 'status')->paginate(10);
        return view('modules.index', compact('modules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modules.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:modules',
            'semester' => 'required|integer',
            'description' => 'nullable|string',
            'credit' => 'required|numeric',
            'status' => 'required|in:draft,publish',
        ]);

        if ($validatedData['status'] === 'publish') {
            $validatedData['published_at'] = now();
        }

        Module::create($validatedData);

        return redirect()->route('modules.index')->with('success', 'Module created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Module $module)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Module $module)
    {

        $module = Module::find($module->id);

        if (!$module->isEditable()) {
            return view('errors.error', ['error' => 'Module cannot be edited after 6 hours of publishing.']);
        }

        return view('modules.edit', compact('module'));



    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Module $module)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:modules,code,' . $module->id,
            'semester' => 'required|integer',
            'description' => 'nullable|string',
            'credit' => 'required|numeric',
            'status' => 'required|in:draft,publish',
        ]);

        if ($validatedData['status'] === 'publish') {
            $validatedData['published_at'] = now();
        }

        $module->update($validatedData);

        return redirect()->route('modules.index')->with('success', 'Module updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Module $module)
    {
        if (!$module->isEditable()) {
            return view('errors.error', ['error' => 'Module cannot be deleted after 6 hours of publishing.']);
        }
        $module->delete();

        return redirect()->route('modules.index')->with('success', 'Module deleted successfully.');
    }
}
