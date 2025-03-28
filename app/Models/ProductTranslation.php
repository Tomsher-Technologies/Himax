<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{
  protected $fillable = [
    'product_id',
    'name',
    'specification',
    'description',
    'lang'
  ];

  public function product()
  {
    return $this->belongsTo(Product::class);
  }
}
