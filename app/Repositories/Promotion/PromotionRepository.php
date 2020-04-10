<?php

namespace App\Repositories\Promotion;

use App\Promotion;
use App\Repositories\Promotion\PromotionRepositoryInterface as PromotionInterface;

class PromotionRepository implements PromotionInterface
{
  public $promotion;

  public function __construct(Promotion $promotion)
  {
     $this->promotion = $promotion;
  }

  public function getAll(){
    return $this->promotion::whereNull('deleted_at')->paginate(5);
  }

  public function find($id)
  {
    return $this->promotion::where('id', '=', $id)->first();
  }

  public function destroy($id)
  {
    return $this->promotion::find($id)->delete();
  }

  public function total()
  {
    return $this->promotion::count();
  }

  public function store($data){
      $this->promotion->fill($data);
      if ($this->promotion->save()) {
        return $this->promotion->id;
      }
  }

  public function delete($id)
  {
    $this->promotion = $this->promotion->find($id);
    $this->promotion->softdelete();
  }

  public function update($request, $id)
  {
    $this->promotion = $this->promotion->find($id);
    $this->promotion->fill($request);
    if ($this->promotion->save()) {
        return true;
    }
  }
}
