<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
  /**
   * Register services.
   */
  public function register(): void
  {
    //
  }

  /**
   * Bootstrap services.
   */
  public function boot(): void
  {
    $verticalMenuJson = file_get_contents(base_path('resources/menu/verticalMenu.json'));
    $verticalMenuData = json_decode($verticalMenuJson);


      $ownerverticalMenuJson = file_get_contents(base_path('resources/menu/verticalMenu_owner.json'));
      $ownerverticalMenuData = json_decode($ownerverticalMenuJson);


    $horizontalMenuJson = file_get_contents(base_path('resources/menu/horizontalMenu.json'));
    $horizontalMenuData = json_decode($horizontalMenuJson);

    //dd(Auth::id());
    // Share all menuData to all the views
    \View::share('menuData', [$verticalMenuData, $horizontalMenuData,$ownerverticalMenuData]);
  }
}
