<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $table = 'product';
  protected $fillable = [
      'name', 'price', 'quantity', 'image', 'category_id', 'promotion_id', 'size', 'description', 'brand_id'
  ];
  protected $hidden = [
      'deleted_at', 'created_at', 'updated_at'
  ];

  public function category()
  {
    return $this->belongsTo(Category::class);
  }

  public function promotion()
  {
    return $this->belongsTo(Promotion::class);
  }

  public function brand()
  {
    return $this->belongsTo(Brand::class);
  }

}
