<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
  protected $table = 'delivery';
  protected $fillable = [
      'customer_name', 'order_id', 'phone', 'address'
  ];
  protected $hidden = [
      'deleted_at', 'created_at', 'updated_at'
  ];

  public function order()
  {
    return $this->belongsTo(Order::class);
  }

}
