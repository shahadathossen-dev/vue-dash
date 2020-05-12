<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;
use App\Models\Backend\System\ActivityLog;

class WatchDog
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
        $response = $next($request);

        $user_id = $request->user()->id;
        $user_ip = $request->ip();
        $link_uri = $request->url();
        $post_data = $request->isMethod('post') ? json_encode($request->except('_token')) : NULL;
        $action = Route::currentRouteName();
        $status = $response->getStatusCode();

        $logActivity = ActivityLog::create([
                                'admin_id' => $user_id,
                                'user_ip' => $user_ip,
                                'link_uri' => $link_uri,
                                'post_data' => $post_data,
                                'action' => $action,
                                'status' => $status,
                            ]);
        return $response;

    }
}
