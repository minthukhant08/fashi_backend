<?php
namespace App\Repositories\Order;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\Order\OrderRepository;


class OrderRepoServiceProvider extends ServiceProvider
{

  public function boot()
  {
    // code...
  }

  public function register()
  {
    $this->app->bind('App\Repositories\Order\OrderRepositoryInterface', 'App\Repositories\Order\OrderRepository');
  }
}
