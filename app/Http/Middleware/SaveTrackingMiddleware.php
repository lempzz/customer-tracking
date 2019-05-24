<?php

namespace App\Http\Middleware;

use App\Components\Tracking\TrackingInterface;
use Closure;
use Illuminate\Http\Request;

class SaveTrackingMiddleware
{
    private $tracking;

    public function __construct(TrackingInterface $tracking)
    {
        $this->tracking = $tracking;
    }

    public function handle(Request $request, Closure $next)
    {
        $res = $next($request);

        $res->withCookie($this->tracking->cookie());

        return $res;
    }

    public function terminate()
    {
        $this->tracking->save();
    }
}
