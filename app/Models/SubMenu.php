<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubMenu extends Model
{
    use HasFactory;
    
    protected $fillable = ['menu_id', 'title', 'link', 'sort_order'];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
