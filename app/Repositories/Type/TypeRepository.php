<?php

namespace App\Repositories\Type;

use App\Type;
use App\Repositories\Type\TypeRepositoryInterface as TypeInterface;

class TypeRepository implements TypeInterface
{
  public $type;

  public function __construct(Type $type)
  {
     $this->type = $type;
  }

  public function getAll(){
    return $this->type::whereNull('deleted_at')->orderBy('created_at','desc')->paginate(5);
  }

  public function find($id)
  {
    return $this->type::where('id', '=', $id)->first();
  }

  public function destroy($id)
  {
    return $this->type::find($id)->delete();
  }

  public function total()
  {
    return $this->type::count();
  }

  public function store($data){
      $this->type->fill($data);
      if ($this->type->save()) {
        return $this->type->id;
      }
  }

  public function delete($id)
  {
    $this->type = $this->type->find($id);
    $this->type->softdelete();
  }

  public function update($request, $id)
  {
    $this->type = $this->type->find($id);
    $this->type->fill($request);
    if ($this->type->save()) {
        return true;
    }
  }
}
