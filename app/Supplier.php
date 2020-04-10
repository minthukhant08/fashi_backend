<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
  protected $table = 'supplier';
  protected $fillable = [
      'name'
  ];
  protected $hidden = [
      'deleted_at', 'created_at', 'updated_at'
  ];
}
