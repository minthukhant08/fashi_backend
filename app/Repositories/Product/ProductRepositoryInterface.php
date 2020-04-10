<?php
namespace App\Repositories\Product;

interface ProductRepositoryInterface{
  public function getAll();
  public function restock();
  public function find($id);
  public function store($data);
  public function update($request, $id);
  public function delete($id);
}
