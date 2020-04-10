<?php
namespace App\Repositories\Brand;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Brand\BrandRepositoryInterface;
use App\Repositories\Brand\BrandRepository;


class BrandRepoServiceProvider extends ServiceProvider
{

  public function boot()
  {
    // code...
  }

  public function register()
  {
    $this->app->bind('App\Repositories\Brand\BrandRepositoryInterface', 'App\Repositories\Brand\BrandRepository');
  }
}
