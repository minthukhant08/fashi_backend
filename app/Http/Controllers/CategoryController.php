<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Category\CategoryRepositoryInterface as CategoryInterface;
use Validator;

class CategoryController extends Controller
{
    public $categoryInterface;

    public function __construct(Request $request, CategoryInterface $categoryInterface)
    {
        $this->categoryInterface = $categoryInterface;
    }

    public function index(Request $request)
    {
      $categorys = $this->categoryInterface->getAll();
      return view('setups.category.index')->with('categorys', $categorys);
    }

    public function store(Request $request)
    {
      $validator = Validator::make($request->all(), [
            'name'          =>  'required'
        ]);

      if ($validator->fails()) {
        return response('Hello World', 400)
                    ->header('Content-Type', 'application/json');
      }

     $category = $request->all();
     $result = $this->categoryInterface->store($category);

     if (isset($result)) {
        return \Response::json($result);
     }else{
       return response('Validation Failed', 400)
                   ->header('Content-Type', 'application/json');
     }
    }

    public function destroy($id)
    {
        $category = $this->categoryInterface->find($id);
        if (!empty($category)) {
          $this->categoryInterface->destroy($id);
          return redirect('/category');
        }
    }

    public function update(Request $request, $id)
    {
      $validator = Validator::make($request->all(), [
            'name'          =>  'required'
        ]);

      if ($validator->fails()) {
        return response('Validation Failed', 400)
                    ->header('Content-Type', 'application/json');
      }

      $category = $this->categoryInterface->find($id);
      if (!empty($category)) {
        if ($this->categoryInterface->update($request->all(),$id)) {
            return \Response::json(true);
        }else{
            return \Response::json(true);
        }
      }
    }
}
