<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Type\TypeRepositoryInterface as TypeInterface;
use Validator;

class TypeController extends Controller
{
    public $typeInterface;

    public function __construct(Request $request, TypeInterface $typeInterface)
    {
        $this->typeInterface = $typeInterface;
    }

    public function index(Request $request)
    {
      $types = $this->typeInterface->getAll();
      return view('setups.type.index')->with('types', $types);
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

     $type = $request->all();
     $result = $this->typeInterface->store($type);

     if (isset($result)) {
        return \Response::json($result);
     }else{
        return \Response::json($result);
     }
    }

    public function destroy($id)
    {
        $type = $this->typeInterface->find($id);
        if (!empty($type)) {
          $this->typeInterface->destroy($id);
          return redirect('/type');
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

      $type = $this->typeInterface->find($id);
      if (!empty($type)) {
        if ($this->typeInterface->update($request->all(),$id)) {
            return \Response::json(true);
        }else{
            return \Response::json(true);
        }
      }
    }
}
