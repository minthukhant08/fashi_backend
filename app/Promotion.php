<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
  protected $table = 'promotion';
  protected $fillable = [
      'name', 'amount'
  ];
  protected $hidden = [
      'deleted_at', 'created_at', 'updated_at'
  ];
}
