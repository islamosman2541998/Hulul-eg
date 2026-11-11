<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * http://hululeg.com answered every page with a 200 and http:// canonicals: a full copy of the
 * site next to the https one. Plain-http page views move to https permanently.
 * Development hosts (localhost, *.test) are left alone.
 */
class ForceHttps
{
    public function handle(Request $request, Closure $next)
    {
        if (! $request->secure() && $request->isMethodSafe() && ! $this->isDevelopmentHost($request->getHost())) {
            return redirect()->to('https://' . $request->getHttpHost() . $request->getRequestUri(), 301);
        }

        return $next($request);
    }

    private function isDevelopmentHost(string $host): bool
    {
        return in_array($host, ['localhost', '127.0.0.1', '::1', '[::1]'], true)
            || preg_match('/\.(test|localhost|local)$/', $host) === 1;
    }
}
