<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Setting;

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
        // Paginator::useBootstrap(); // Nếu dùng Bootstrap 4
        Paginator::useBootstrapFive(); // Nếu dùng Bootstrap 5
        // Lấy setting đầu tiên
        $setting = Setting::first();

        // lấy liên hệ đầu tiên
        $contact = Contact::first();

        // Chia sẻ cho tất cả view
        View::share([
            'setting' => $setting,
            'contact' => $contact,
        ]);
    }
}
