<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
  /**
   * The model to policy mappings for the application.
   *
   * @var array<class-string, class-string>
   */
  protected $policies = [
    'App\Models\Model' => 'App\Policies\ModelPolicy',
  ];

  /**
   * Register any authentication / authorization services.
   *
   * @return void
   */
  public function boot()
  {
    $this->registerPolicies();

    Passport::routes();

    $this->commands([
      \Laravel\Passport\Console\InstallCommand::class,
      \Laravel\Passport\Console\ClientCommand::class,
      \Laravel\Passport\Console\KeysCommand::class,
    ]);

    Passport::tokensExpireIn(\Carbon\Carbon::now()->addMinutes(10));
    Passport::refreshTokensExpireIn(\Carbon\Carbon::now()->addDays(1));
    Passport::personalAccessTokensExpireIn(\Carbon\Carbon::now()->addDays(1));
  }
}
