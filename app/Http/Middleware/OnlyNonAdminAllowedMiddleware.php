<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OnlyNonAdminAllowedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $appIsLive = Setting::where('key', Setting::CLIENT_APP_IS_LIVE)->first();

        if (Setting::where('key', Setting::CLIENT_APP_IS_LIVE)->first()?->value === '0') {
            return abort(404, 'The app is currently disabled');
        }

        if (!auth()->user()?->is_admin) {
            return $next($request);
        }

        return redirect('/admin');
    }
}
