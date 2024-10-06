<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Course;
use App\Models\Module;
use App\Models\Rules;
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

        $courses = $query->select('id','name','faculty','category','status')->paginate(10);
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

        if(!$course->isEditable()){
            return view('errors.error', ['error' => 'Course cannot be edited after 6 hours of publishing.']);
        }

        $all_modules = Module::where('status', 'publish')->get();

        $rules = Rules::where('course_id', $course->id)->get();


        return view('courses.edit', compact('course', 'all_modules','rules'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'seo_url' => 'required|string|max:255',
            'faculty' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'status' => 'required|in:draft,publish',
        ]);

        if ($request->input('status') === 'publish') {
            $request->merge(['published_at' => now()]);
        }

        $course->update($request->all());

        return redirect()->route('courses.edit',[$course->id])->with('success', 'Course updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        if(!$course->isEditable()){
            return view('errors.error', ['error' => 'Course cannot be deleted after 6 hours of publishing.']);
        }

        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');

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

    public function destroyBatch(Request $request)
    {
        $request->validate([
            'batch_id' => 'required|integer|exists:batches,id',
        ]);

        $batch = Batch::find($request->input('batch_id'));

        $batch->delete();

        return response()->json(['message' => 'Batch deleted successfully.']);
    }

    public function addModule(Request $request)
    {
        $request->validate([
            'module_id' => 'required|integer|exists:modules,id',
            'batch_id' => 'required|integer|exists:batches,id',
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
            'batch_id' => 'required|integer|exists:batches,id',
        ]);
        
        $batch = Batch::find($request->input('batch_id'));
        $batch->modules()->detach($request->input('module_id'));
        
        return response()->json(['message' => 'Module removed successfully.']);
    }

    public function storeRule(Request $request)
    {
        $request->validate([
            'course_id' => 'required|integer|exists:courses,id',
            'semester' => 'required|integer',
            'elective_module_count' => 'required|integer',
        ]);

        $course = Course::find($request->input('course_id'));

        $ruleData = $request->json()->all();

        Rules::create([
            'semester' => $ruleData['semester'],
            'elective_module_count' => $ruleData['elective_module_count'],
            'course_id' => $course->id,
        ]);

        return response()->json(['message' => 'Rule created successfully.']);
    }

    public function destroyRule(Request $request)
    {
        $request->validate([
            'rule_id' => 'required|integer|exists:rules,id',
        ]);

        $rule = Rules::find($request->input('rule_id'));

        $rule->delete();

        return response()->json(['message' => 'Rule deleted successfully.']);
    }
}
