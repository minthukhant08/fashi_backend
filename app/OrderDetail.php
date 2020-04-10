<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
  protected $table = 'order_detail';
  protected $fillable = [
      'quantity', 'price', 'amount', 'product_id', 'order_id'
  ];
  protected $hidden = [
      'deleted_at', 'created_at', 'updated_at'
  ];
}
