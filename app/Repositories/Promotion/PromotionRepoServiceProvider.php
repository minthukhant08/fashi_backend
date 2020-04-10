<?php
namespace App\Repositories\Promotion;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Promotion\PromotionRepositoryInterface;
use App\Repositories\Promotion\PromotionRepository;


class PromotionRepoServiceProvider extends ServiceProvider
{

  public function boot()
  {
    // code...
  }

  public function register()
  {
    $this->app->bind('App\Repositories\Promotion\PromotionRepositoryInterface', 'App\Repositories\Promotion\PromotionRepository');
  }
}
