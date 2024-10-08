<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentElectiveMoudle extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'module_id',
        'batch_id',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }
}
