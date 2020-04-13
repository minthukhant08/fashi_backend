<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Promotion\PromotionRepositoryInterface as PromotionInterface;
use Validator;

class PromotionController extends Controller
{
    public $promotionInterface;

    public function __construct(Request $request, PromotionInterface $promotionInterface)
    {
        $this->middleware('auth');
        $this->promotionInterface = $promotionInterface;
    }

    public function index(Request $request)
    {
      $promotions = $this->promotionInterface->getAll();
      return view('setups.promotion.index')->with('promotions', $promotions);
    }

    public function store(Request $request)
    {
      $validator = Validator::make($request->all(), [
            'name'          =>  'required',
            'amount'        =>  'numeric'
        ]);

      if ($validator->fails()) {
        return response('Validation Failed', 400)
                    ->header('Content-Type', 'application/json');
      }

     $promotion = $request->all();
     $result = $this->promotionInterface->store($promotion);

     if (isset($result)) {
        return \Response::json($result);
     }else{
        return \Response::json($result);
     }
    }

    public function destroy($id)
    {
        $promotion = $this->promotionInterface->find($id);
        if (!empty($promotion)) {
          $this->promotionInterface->destroy($id);
          return redirect('/promotion');
        }
    }

    public function update(Request $request, $id)
    {
      $validator = Validator::make($request->all(), [
            'name'          =>  'required',
            'amount'        =>  'numeric'
        ]);

      if ($validator->fails()) {
        return response('Validation Failed', 400)
                    ->header('Content-Type', 'application/json');
      }

      $promotion = $this->promotionInterface->find($id);
      if (!empty($promotion)) {
        if ($this->promotionInterface->update($request->all(),$id)) {
            return \Response::json(true);
        }else{
            return \Response::json(true);
        }
      }
    }
}
