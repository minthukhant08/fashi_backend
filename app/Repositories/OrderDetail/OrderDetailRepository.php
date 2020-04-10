<?php

namespace App\Repositories\OrderDetail;

use App\OrderDetail;
use App\Repositories\OrderDetail\OrderDetailRepositoryInterface as OrderDetailInterface;

class OrderDetailRepository implements OrderDetailInterface
{
  public $orderDetail;

  public function __construct(OrderDetail $orderDetail)
  {
     $this->orderDetail = $orderDetail;
  }

  public function getAll(){
    return $this->orderDetail::whereNull('deleted_at')->get();
  }

  public function find($id)
  {
    return $this->orderDetail::where('id', '=', $id)->first();
  }

  public function destroy($id)
  {
    return $this->orderDetail::find($id)->delete();
  }

  public function total()
  {
    return $this->orderDetail::count();
  }

  public function store($data){
    $temp = new OrderDetail();
      $temp->fill($data);
      if ($temp->save()) {
        return $temp->id;
      }
  }

  public function delete($id)
  {
    $this->orderDetail = $this->orderDetail->find($id);
    $this->orderDetail->softdelete();
  }

  public function update($request, $id)
  {
    $this->orderDetail = $this->orderDetail->find($id);
    $this->orderDetail->fill($request);
    if ($this->orderDetail->save()) {
        return true;
    }
  }
}
