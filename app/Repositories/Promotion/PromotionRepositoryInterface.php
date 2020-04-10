<?php
namespace App\Repositories\Promotion;

interface PromotionRepositoryInterface{
  public function getAll();
  public function find($id);
  public function store($data);
  public function update($request, $id);
  public function delete($id);
}
