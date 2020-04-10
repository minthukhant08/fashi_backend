<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Order\OrderRepositoryInterface as OrderInterface;
use App\Repositories\Delivery\DeliveryRepositoryInterface as DeliveryInterface;
use Validator;

class OrderController extends Controller
{
    public $orderInterface;
    public $deliveryInterface;

    public function __construct(Request $request, OrderInterface $orderInterface, DeliveryInterface $deliveryInterface)
    {
        $this->orderInterface = $orderInterface;
        $this->deliveryInterface = $deliveryInterface;
    }

    public function index(Request $request)
    {
      $orders = $this->orderInterface->getAll();
      return view('order.index')->with('orders', $orders);
    }

    public function store(Request $request)
    {
      $validator = Validator::make($request->all(), [
            'name'          =>  'required'
        ]);

      if ($validator->fails()) {
        return response('Validation Failed', 400)
                    ->header('Content-order', 'application/json');
      }

     $order = $request->all();
     $result = $this->orderInterface->store($order);

     if (isset($result)) {
        return \Response::json($result);
     }else{
        return \Response::json($result);
     }
    }

    public function destroy($id)
    {
        $order = $this->deliveryInterface->find($id);
        if (!empty($order)) {
          $this->deliveryInterface->destroy($id);
          return redirect('/order/delivery');
        }
    }

    public function update(Request $request, $id)
    {
      $validator = Validator::make($request->all(), [
            'name'          =>  'required'
        ]);

      if ($validator->fails()) {
        return response('Validation Failed', 400)
                    ->header('Content-order', 'application/json');
      }

      $order = $this->orderInterface->find($id);
      if (!empty($order)) {
        if ($this->orderInterface->update($request->all(),$id)) {
            return \Response::json(true);
        }else{
            return \Response::json(true);
        }
      }
    }
    public function delivery()
    {
      $deli_list = $this->orderInterface->delivery();
      return view('order.delivery')->with('deliverys', $deli_list);
    }
}
