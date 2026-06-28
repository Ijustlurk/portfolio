<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\PageView;

class TrackPageViews
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $path = $request->path();

        // Only track requests that are not CMS paths, health checks, or AJAX/JSON requests
        if (!str_starts_with($path, 'cms') && $path !== 'up' && !$request->ajax() && !$request->wantsJson()) {
            try {
                PageView::create([
                    'ip_address' => hash('sha256', $request->ip() . config('app.key')),
                    'user_agent' => $request->userAgent(),
                    'url' => $request->fullUrl(),
                    'path' => $path === '/' ? 'Home' : $path,
                    'referer' => $request->header('referer'),
                ]);
            } catch (\Exception $e) {
                // Fail silently to prevent application crashes
                logger()->error('Analytics Tracking Error: ' . $e->getMessage());
            }
        }

        return $next($request);
    }
}
