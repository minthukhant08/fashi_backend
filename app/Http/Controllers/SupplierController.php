<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Supplier\SupplierRepositoryInterface as SupplierInterface;
use Validator;

class SupplierController extends Controller
{
    public $supplierInterface;

    public function __construct(Request $request, SupplierInterface $supplierInterface)
    {
        $this->middleware('auth');
        $this->supplierInterface = $supplierInterface;
    }

    public function index(Request $request)
    {
      $suppliers = $this->supplierInterface->getAll();
      return view('setups.supplier.index')->with('suppliers', $suppliers);
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

     $supplier = $request->all();
     $result = $this->supplierInterface->store($supplier);

     if (isset($result)) {
        return \Response::json($result);
     }else{
        return \Response::json($result);
     }
    }

    public function destroy($id)
    {
        $supplier = $this->supplierInterface->find($id);
        if (!empty($supplier)) {
          $this->supplierInterface->destroy($id);
          return redirect('/supplier');
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

      $supplier = $this->supplierInterface->find($id);
      if (!empty($supplier)) {
        if ($this->supplierInterface->update($request->all(),$id)) {
            return \Response::json(true);
        }else{
            return \Response::json(true);
        }
      }
    }
}
