<?php

namespace App\Http\Middleware;

use Closure;
use Jenssegers\Agent\Agent;

class CheckPlatform
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $agent = new Agent();

        if($agent->isMobile()){return redirect('/under-construction');}
        if($agent->browser() === 'IE'){return redirect('/under-construction');}
        if($agent->isTablet()){return redirect('/under-construction');}
        if($agent->isRobot()){return redirect('/under-construction');}

        return $next($request);
    }
}
