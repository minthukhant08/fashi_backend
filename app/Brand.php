<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
  protected $table = 'brand';
  protected $fillable = [
      'name'
  ];
  protected $hidden = [
      'deleted_at', 'created_at', 'updated_at'
  ];
}
