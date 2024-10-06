<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'seo_url', 'faculty', 'category','status','published_at'];

    public function batchs()
    {
        return $this->hasMany(Batch::class);
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

    public function rules()
    {
        return $this->hasMany(Rules::class);
    }

}
