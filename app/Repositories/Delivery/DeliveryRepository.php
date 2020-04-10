<?php

namespace App\Repositories\Delivery;

use App\Delivery;
use App\Repositories\Delivery\DeliveryRepositoryInterface as DeliveryInterface;

class DeliveryRepository implements DeliveryInterface
{
  public $delivery;

  public function __construct(Delivery $delivery)
  {
     $this->delivery = $delivery;
  }

  public function getAll(){
    return $this->delivery::whereNull('deleted_at')->get();
  }

  public function find($id)
  {
    return $this->delivery::where('id', '=', $id)->first();
  }

  public function destroy($id)
  {
    return $this->delivery::find($id)->delete();
  }

  public function total()
  {
    return $this->delivery::count();
  }

  public function store($data){
      $this->delivery->fill($data);
      if ($this->delivery->save()) {
        return $this->delivery->id;
      }
  }

  public function delete($id)
  {
    $this->delivery = $this->delivery->find($id);
    $this->delivery->softdelete();
  }

  public function update($request, $id)
  {
    $this->delivery = $this->delivery->find($id);
    $this->delivery->fill($request);
    if ($this->delivery->save()) {
        return true;
    }
  }
}
