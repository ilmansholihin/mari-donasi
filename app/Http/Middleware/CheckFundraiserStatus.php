<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Fundraisers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckFundraiserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    //  public function handle($request, Closure $next)
    // {
    //     if (Auth::check()) {
    //         $fundraiser = Fundraisers::where('users_id', Auth::id())->first();
    //         view()->share('fundraiser', $fundraiser);
    //     } else {
    //         view()->share('fundraiser', null);
    //     }

    //     return $next($request);
    // }
}
