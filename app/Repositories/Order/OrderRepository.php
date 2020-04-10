<?php

namespace App\Repositories\Order;

use App\Order;
use App\Repositories\Order\OrderRepositoryInterface as OrderInterface;
use App\Delivery;

class OrderRepository implements OrderInterface
{
  public $order;

  public function __construct(Order $order)
  {
     $this->order = $order;
  }

  public function getAll(){
    return $this->order::with('orderdetails')->whereNull('deleted_at')->paginate(10);
  }

  public function find($id)
  {
    return $this->order::where('id', '=', $id)->first();
  }

  public function destroy($id)
  {
    return $this->order::find($id)->delete();
  }

  public function total()
  {
    return $this->order::count();
  }

  public function store($data){
      $this->order->fill($data);
      if ($this->order->save()) {
        return $this->order->id;
      }
  }

  public function delete($id)
  {
    $this->order = $this->order->find($id);
    $this->order->softdelete();
  }

  public function update($request, $id)
  {
    $this->order = $this->order->find($id);
    $this->order->fill($request);
    if ($this->order->save()) {
        return true;
    }
  }

  public function delivery()
  {
     return  $this->order::with('delivery')->whereNull('deleted_at')->paginate(10);

  }
}
