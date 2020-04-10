<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  protected $table = 'order';
  protected $fillable = [
      'customer_id', 'payment_type', 'bank_type', 'bank_account', 'total_amount', 'order_date'
  ];
  protected $hidden = [
      'deleted_at', 'created_at', 'updated_at'
  ];

  public function orderdetails()
  {
    return $this->hasMany(OrderDetail::class);
  }

  public function delivery()
  {
    return $this->hasOne('App\Delivery', 'order_id', 'id');
  }
}
