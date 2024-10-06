<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rules extends Model
{
    use HasFactory;

    protected $fillable = ['course_id', 'semester', 'elective_module_count'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
