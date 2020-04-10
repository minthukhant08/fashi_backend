<?php
namespace App\Repositories\Category;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Category\CategoryRepository;


class CategoryRepoServiceProvider extends ServiceProvider
{

  public function boot()
  {
    // code...
  }

  public function register()
  {
    $this->app->bind('App\Repositories\Category\CategoryRepositoryInterface', 'App\Repositories\Category\CategoryRepository');
  }
}
