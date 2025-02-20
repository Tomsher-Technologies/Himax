<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Industries extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'image', 'title', 'content', 'status', 'sort_order'
    ];

}
