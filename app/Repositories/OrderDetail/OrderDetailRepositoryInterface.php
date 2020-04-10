<?php
namespace App\Repositories\OrderDetail;

interface OrderDetailRepositoryInterface{
  public function getAll();
  public function find($id);
  public function store($data);
  public function update($request, $id);
  public function delete($id);
}
