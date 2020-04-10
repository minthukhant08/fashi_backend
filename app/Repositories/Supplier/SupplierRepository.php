<?php

namespace App\Repositories\Supplier;

use App\Supplier;
use App\Repositories\Supplier\SupplierRepositoryInterface as SupplierInterface;

class SupplierRepository implements SupplierInterface
{
  public $supplier;

  public function __construct(Supplier $supplier)
  {
     $this->supplier = $supplier;
  }

  public function getAll(){
    return $this->supplier::whereNull('deleted_at')->orderBy('created_at','desc')->paginate(5);
  }

  public function find($id)
  {
    return $this->supplier::where('id', '=', $id)->first();
  }

  public function destroy($id)
  {
    return $this->supplier::find($id)->delete();
  }

  public function total()
  {
    return $this->supplier::count();
  }

  public function store($data){
      $this->supplier->fill($data);
      if ($this->supplier->save()) {
        return $this->supplier->id;
      }
  }

  public function delete($id)
  {
    $this->supplier = $this->supplier->find($id);
    $this->supplier->softdelete();
  }

  public function update($request, $id)
  {
    $this->supplier = $this->supplier->find($id);
    $this->supplier->fill($request);
    if ($this->supplier->save()) {
        return true;
    }
  }
}
