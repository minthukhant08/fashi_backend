<?php

namespace App\Repositories\Brand;

use App\Brand;
use App\Repositories\Brand\BrandRepositoryInterface as BrandInterface;

class BrandRepository implements BrandInterface
{
  public $brand;

  public function __construct(Brand $brand)
  {
     $this->brand = $brand;
  }

  public function getAll(){
    return $this->brand::whereNull('deleted_at')->paginate(5);
  }

  public function find($id)
  {
    return $this->brand::where('id', '=', $id)->first();
  }

  public function destroy($id)
  {
    return $this->brand::find($id)->delete();
  }

  public function total()
  {
    return $this->brand::count();
  }

  public function store($data){
      $this->brand->fill($data);
      if ($this->brand->save()) {
        return $this->brand->id;
      }
  }

  public function delete($id)
  {
    $this->brand = $this->brand->find($id);
    $this->brand->softdelete();
  }

  public function update($request, $id)
  {
    $this->brand = $this->brand->find($id);
    $this->brand->fill($request);
    if ($this->brand->save()) {
        return true;
    }
  }
}
