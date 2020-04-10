<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  protected $table = 'category';
  protected $fillable = [
      'name'
  ];
  protected $hidden = [
      'deleted_at', 'created_at', 'updated_at'
  ];
}
