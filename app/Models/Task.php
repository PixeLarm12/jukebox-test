<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = "tasks";

    protected $fillable = [
        "title",
        "description",
        "user_id",
    ];

    public function scopeGetAllTasks()
    {
        return self::where('user_id', Auth::user()->id)->get();
    }
}
