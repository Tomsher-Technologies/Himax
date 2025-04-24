<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['title', 'sort_order'];

    public function subMenus()
    {
        return $this->hasMany(SubMenu::class)->orderBy('sort_order');
    }
}
