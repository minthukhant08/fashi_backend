<?php
namespace App\Repositories\Delivery;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Delivery\DeliveryRepositoryInterface;
use App\Repositories\Delivery\DeliveryRepository;


class DeliveryRepoServiceProvider extends ServiceProvider
{

  public function boot()
  {
    // code...
  }

  public function register()
  {
    $this->app->bind('App\Repositories\Delivery\DeliveryRepositoryInterface', 'App\Repositories\Delivery\DeliveryRepository');
  }
}
