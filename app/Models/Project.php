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

    protected $casts = [
        'date' => 'date'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}