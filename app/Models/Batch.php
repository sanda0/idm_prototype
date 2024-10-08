<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'course_id'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }


    public function modules()
    {
        return $this->belongsToMany(Module::class)->orderBy('semester');
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function getElectiveModulesBySemester($semester)
    {

        return $this->belongsToMany(Module::class)->where('semester', $semester)->where('category', 'elective')->get();

    }
}
