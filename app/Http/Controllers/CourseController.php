<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Course;
use App\Models\Module;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $query = Course::query();

        if ($request->has('search')) {
            $search = strtolower($request->input('search'));
            $query->whereRaw('LOWER(name) like ?', ["%{$search}%"])
              ->orWhereRaw('LOWER(faculty) like ?', ["%{$search}%"])
              ->orWhereRaw('LOWER(category) like ?', ["%{$search}%"]);
        }

        $courses = $query->paginate(10);
        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'seo_url' => 'required|string|max:255',
            'faculty' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            
        ]);

        $course = Course::create($request->all());

        return redirect()->route('courses.edit',[$course->id])->with('success', 'Course created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        
        $course = Course::find($course->id);

        $all_modules = Module::all();

        return view('courses.edit', compact('course', 'all_modules'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
    }

    public function storeBatch(Request $request)
    {
    
        $request->validate([
            'course_id' => 'required|integer|exists:courses,id',
            'name' => 'required|string|max:255',
        ]);

        $course = Course::find($request->input('course_id'));

        $batchData = $request->json()->all();



        Batch::create([
            'name' => $batchData['name'],
            'course_id' => $course->id,
        ]);

        return response()->json(['message' => 'Batch created successfully.']);
    }

    public function destroyBatch(Request $request, Batch $batch)
    {
        $batch->delete();

        return response()->json(['message' => 'Batch deleted successfully.']);
    }

    public function addModule(Request $request)
    {
        $request->validate([
            'module_id' => 'required|integer|exists:modules,id',
            'batch_id' => 'required|integer|exists:courses,id',
        ]);
        
        $batch = Batch::find($request->input('batch_id'));
        if (!$batch->modules()->where('module_id', $request->input('module_id'))->exists()) {
            $batch->modules()->attach($request->input('module_id'));
        }
        
        return response()->json(['message' => 'Module added successfully.']);
    }

    public function removeModule(Request $request)
    {
        $request->validate([
            'module_id' => 'required|integer|exists:modules,id',
            'batch_id' => 'required|integer|exists:courses,id',
        ]);
        
        $batch = Batch::find($request->input('batch_id'));
        $batch->modules()->detach($request->input('module_id'));
        
        return response()->json(['message' => 'Module removed successfully.']);
    }
}
