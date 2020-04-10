<?php
namespace App\Repositories\OrderDetail;

use Illuminate\Support\ServiceProvider;
use App\Repositories\OrderDetail\OrderDetailRepositoryInterface;
use App\Repositories\OrderDetail\OrderDetailRepository;


class OrderDetailRepoServiceProvider extends ServiceProvider
{

  public function boot()
  {
    // code...
  }

  public function register()
  {
    $this->app->bind('App\Repositories\OrderDetail\OrderDetailRepositoryInterface', 'App\Repositories\OrderDetail\OrderDetailRepository');
  }
}
