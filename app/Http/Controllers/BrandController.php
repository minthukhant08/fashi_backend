<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Brand\BrandRepositoryInterface as BrandInterface;
use Validator;

class BrandController extends Controller
{
    public $brandInterface;

    public function __construct(Request $request, BrandInterface $brandInterface)
    {
        $this->middleware('auth');
        $this->brandInterface = $brandInterface;
    }

    public function index(Request $request)
    {
      $brands = $this->brandInterface->getAll();
      return view('setups.brand.index')->with('brands', $brands);
    }

    public function store(Request $request)
    {
      $validator = Validator::make($request->all(), [
            'name'          =>  'required'
        ]);

      if ($validator->fails()) {
        return response('Validation Failed', 400)
                    ->header('Content-Type', 'application/json');
      }

     $brand = $request->all();
     $result = $this->brandInterface->store($brand);

     if (isset($result)) {
        return \Response::json($result);
     }else{
        return \Response::json($result);
     }
    }

    public function destroy($id)
    {
        $brand = $this->brandInterface->find($id);
        if (!empty($brand)) {
          $this->brandInterface->destroy($id);
          return redirect('/brand');
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

      $brand = $this->brandInterface->find($id);
      if (!empty($brand)) {
        if ($this->brandInterface->update($request->all(),$id)) {
            return \Response::json(true);
        }else{
            return \Response::json(true);
        }
      }
    }
}
