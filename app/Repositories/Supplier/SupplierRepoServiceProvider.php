<?php
namespace App\Repositories\Supplier;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Supplier\SupplierRepositoryInterface;
use App\Repositories\Supplier\SupplierRepository;


class SupplierRepoServiceProvider extends ServiceProvider
{

  public function boot()
  {
    // code...
  }

  public function register()
  {
    $this->app->bind('App\Repositories\Supplier\SupplierRepositoryInterface', 'App\Repositories\Supplier\SupplierRepository');
  }
}
