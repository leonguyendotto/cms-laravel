<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'url',
        'content',
        'slug',
        'image',
        'user_id',
    ];

    public function user ()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function getRouteKeyName ()
    {
        return 'slug';
    }
}
