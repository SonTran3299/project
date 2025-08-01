<?php

namespace App\Providers;

use App\Models\Contact;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AdminViewServiceProvider extends ServiceProvider
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
        View::composer('admin.*', function ($view) {
            $view->with('messages', Contact::orderBy('updated_at', 'desc')->with('user')->take(5)->get());
            $view->with('messageCount', Contact::where('status', '=', '0')->count());
        });
    }
}
