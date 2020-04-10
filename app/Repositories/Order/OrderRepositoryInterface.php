<?php
namespace App\Repositories\Order;

interface OrderRepositoryInterface{
  public function getAll();
  public function find($id);
  public function store($data);
  public function update($request, $id);
  public function delete($id);
  public function delivery();
}
