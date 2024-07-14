<?php

namespace App\Providers;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class NotificationServiceProvider extends ServiceProvider
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
    public function boot()
    {
        View::composer('*', function ($view) {
            if (auth()->check()) {

                if (Auth::user()->Role == "Admin") {
                    $admin_notifications = Notification::where('user_type', 'admin')
                        ->Orderby('is_read')
                        ->latest()
                        ->get();
                } else {
                    $admin_notifications = Notification::where('user_type', 'user')
                        ->where('user_id', Auth::user()->id)
                        ->Orderby('is_read')
                        ->latest()
                        ->get();

                }
                $view->with('admin_notifications', $admin_notifications);
            }
        });
    }
}
