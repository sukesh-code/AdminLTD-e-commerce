<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\User;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('isAdmin', function (User $user) {
            return $user->role == 'admin';
        });

        Gate::define('isAdmin2', function (User $user) {
            return $user->role == 'admin';
        });


        Gate::define('isUser', function (User $user) {
            return $user->role == 'user';
        });

        Gate::define('isSeller', function (User $user) {
            return $user->role == 'seller';
        });


        View::composer('e-commerce.category-select', function ($view) {

            $categories = Category::whereNull('parent_id')->get();

            $view->with('categories', $categories);
        });



        $this->configureDefaults();
    }

    /**
     * Configure default behaviors for production-ready applications.
     */
    protected function configureDefaults(): void
    {
        Date::use(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(
            app()->isProduction(),
        );

        Password::defaults(
            fn(): ?Password => app()->isProduction()
                ? Password::min(12)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised()
                : null,
        );
    }
}
