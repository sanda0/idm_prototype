<?php

namespace App\Http\Controllers;

use App\Models\Rules;
use App\Models\StudentElectiveMoudle;
use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
    public function index()
    {


        if (auth()->user()->hasRole('Student')) {
        
            $electoveModulesCount = count(auth()->user()->student->electiveModules());
    
            if ($electoveModulesCount == 0) {
                return redirect()->route('elective-module-selection');

            }
            return view('dashboard');
        }

        return view('dashboard');
    }

    public function electiveModuleSelection()
    {


        $course_id = auth()->user()->student->batch->course_id;


        $semesters = Rules::select('semester', 'elective_module_count')->where("course_id", $course_id)->get();



        return view('elective-module-selection', ['semesters' => $semesters]);
    }

    public function storeElectiveModuleSelection(Request $request)
    {
        $validatedData = $request->validate([
            'course_id' => 'required|integer|exists:courses,id',
            'student_id' => 'required|integer|exists:students,id',
            'batch_id' => 'required|integer|exists:batches,id',
        ]);

        $student = auth()->user()->student;

        foreach ($request->all() as $key => $value) {
            if (preg_match('/^semester_(\d+)_modules$/', $key, $matches)) {
                $semester = $matches[1];
                $moduleIds = $value;

                $rules = Rules::where('course_id', $validatedData['course_id'])
                    ->where('semester', $semester)
                    ->first();


                DB::beginTransaction();

                try {
                    if ($rules && count($moduleIds) == $rules->elective_module_count) {
                        foreach ($moduleIds as $moduleId) {
                            DB::table('student_elective_moudles')->insert([
                                'student_id' => $validatedData['student_id'],
                                'module_id' => $moduleId,
                                'batch_id' => $validatedData['batch_id'],
                            ]);
                        }
                        DB::commit();
                    } else {
                        DB::rollBack();
                        return redirect()->back()->withErrors(['msg' => "Please select exactly {$rules->elective_module_count} modules for semester {$semester}."]);
                    }
                } catch (\Exception $e) {
                    
                    DB::rollBack();
                    dd($e);
                    return redirect()->back()->withErrors(['msg' => 'An error occurred while saving the elective modules.']);
                }
            }
        }

        return redirect()->route('dashboard')->with('success', 'Elective modules selected successfully.');
    }
}
