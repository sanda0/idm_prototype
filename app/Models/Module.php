<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'semester',
        'description',
        'credit',
        'status',
    ];


    public function batches()
    {
        return $this->belongsToMany(Batch::class);
    }
}
