<?php

namespace App\Repositories\Product;

use App\Product;
use App\Repositories\Product\ProductRepositoryInterface as ProductInterface;

class ProductRepository implements ProductInterface
{
  public $product;

  public function __construct(Product $product)
  {
     $this->product = $product;
  }

  public function getAll(){
    return $this->product::with('brand', 'category', 'type', 'promotion')->whereNull('deleted_at')->orderBy('created_at','desc')->paginate(5);
  }

  public function restock(){
    return $this->product::where('quantity', '<=', 0)->whereNull('deleted_at')->orderBy('created_at','desc')->paginate(5);
  }

  public function find($id)
  {
    return $this->product::where('id', '=', $id)->first();
  }

  public function destroy($id)
  {
    return $this->product::find($id)->delete();
  }

  public function total()
  {
    return $this->product::count();
  }

  public function store($data){
      $this->product->fill($data);
      if ($this->product->save()) {
        return $this->product->id;
      }
  }

  public function delete($id)
  {
    $this->product = $this->product->find($id);
    $this->product->softdelete();
  }

  public function update($request, $id)
  {
    $this->product = $this->product->find($id);
    $this->product->fill($request);
    if ($this->product->save()) {
        return true;
    }
  }
}
