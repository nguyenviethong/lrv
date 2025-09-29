<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo($request): ?string
    {
        if (! $request->expectsJson()) {
            // Nếu đường dẫn là admin/*
            if ($request->is('admin/*')) {
                return route('admin.login');
            }

            // Nếu bạn KHÔNG có hệ thống user thường
            // thì có thể cho redirect thẳng về admin login luôn
            return route('admin.login');
        }

        return null;
    }
}
