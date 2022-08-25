<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category_id',
        'client_id',
        'slug',
        'imageOne',
        'imageTwo',
        'github',
        'date',
        'website',
        'description',
    ];
}