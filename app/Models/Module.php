<?php

namespace App\Models;

use Carbon\Carbon;
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
        'published_at'
    ];


    public function batches()
    {
        return $this->belongsToMany(Batch::class);
    }

    public function isEditable()
    {
        $user = auth()->user();
        if ($user->hasRole('Academic Head')) {
            if ($this->status == 'publish' && $this->published_at) {
                $published_at = Carbon::parse($this->published_at);
                if ($published_at->lt(now()->subHours(6))) {
                    return false;
                }
            }
            return true;
        } else {
            return true;
        }
    }
}
