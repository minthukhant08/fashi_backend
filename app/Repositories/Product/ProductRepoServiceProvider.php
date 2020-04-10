<?php
namespace App\Repositories\Product;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Product\ProductRepository;


class ProductRepoServiceProvider extends ServiceProvider
{

  public function boot()
  {
    // code...
  }

  public function register()
  {
    $this->app->bind('App\Repositories\Product\ProductRepositoryInterface', 'App\Repositories\Product\ProductRepository');
  }
}
