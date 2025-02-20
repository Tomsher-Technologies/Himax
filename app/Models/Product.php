<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App;
use URL;

class Product extends Model
{

    protected $fillable = [
        'name', 'sku', 'slug', 'published', 'category_id', 'brand_id', 'thumbnail_img', 'datasheet_pdf', 'added_by', 'user_id'
    ];

    protected $with = ['product_translations','seo'];

    public function getTranslation($field = '', $lang = false)
    {
        $lang = $lang == false ? App::getLocale() : $lang;
        $product_translations = $this->product_translations->where('lang', $lang)->first();
        return $product_translations != null ? $product_translations->$field : $this->$field;
    }

    public function getSeoTranslation($field = '', $lang = false)
    {
        $lang = $lang == false ? App::getLocale() : $lang;
        $seo_translations = $this->seo->where('lang', $lang)->first();
        return $seo_translations != null ? $seo_translations->$field : $this->$field;
    }

    public function product_translations()
    {
        return $this->hasMany(ProductTranslation::class);
    }

    public function seo()
    {
        return $this->hasMany(ProductSeo::class);
    }

    public function image($path)
    {
        return URL::to($path);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
