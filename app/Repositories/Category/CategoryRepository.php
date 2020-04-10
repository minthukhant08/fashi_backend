<?php

namespace App\Repositories\Category;

use App\Category;
use App\Repositories\Category\CategoryRepositoryInterface as CategoryInterface;

class CategoryRepository implements CategoryInterface
{
  public $category;

  public function __construct(Category $category)
  {
     $this->category = $category;
  }

  public function getAll(){
    return $this->category::whereNull('deleted_at')->orderBy('created_at','desc')->paginate(5);
  }

  public function find($id)
  {
    return $this->category::where('id', '=', $id)->first();
  }

  public function destroy($id)
  {
    return $this->category::find($id)->delete();
  }

  public function total()
  {
    return $this->category::count();
  }

  public function store($data){
      $this->category->fill($data);
      if ($this->category->save()) {
        return $this->category->id;
      }
  }

  public function delete($id)
  {
    $this->category = $this->category->find($id);
    $this->category->softdelete();
  }

  public function update($request, $id)
  {
    $this->category = $this->category->find($id);
    $this->category->fill($request);
    if ($this->category->save()) {
        return true;
    }
  }
}
