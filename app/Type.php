<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
  protected $table = 'type';
  protected $fillable = [
      'name'
  ];
  protected $hidden = [
      'deleted_at', 'created_at', 'updated_at'
  ];
}
