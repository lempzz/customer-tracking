<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Components\Tracking\{TrackingInterface, TrackingService, UserTracking};

class TrackingMiddleware
{
    private $tracking;

    public function __construct(TrackingInterface $tracking)
    {
        $this->tracking = $tracking;
    }

    public function handle(Request $request, Closure $next)
    {
        if ($request->has('tel')) {
            $this->tracking->set(UserTracking::phone($request->get('phone')));
        } elseif (
            $request->hasCookie(TrackingService::ANALYTIC_COOKIE_KEY) &&
            $analytic = UserTracking::find($request->cookie(TrackingService::ANALYTIC_COOKIE_KEY))
        ) {
            $this->tracking->set($analytic);
        }

        if ($request->hasHeader('GA-ID')) {
            $this->tracking->addGoogleId($request->header('GA-ID'));
        }

        return $next($request);
    }
}
