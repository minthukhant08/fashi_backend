<?php
namespace App\Repositories\Type;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Type\TypeRepositoryInterface;
use App\Repositories\Type\TypeRepository;


class TypeRepoServiceProvider extends ServiceProvider
{

  public function boot()
  {
    // code...
  }

  public function register()
  {
    $this->app->bind('App\Repositories\Type\TypeRepositoryInterface', 'App\Repositories\Type\TypeRepository');
  }
}
