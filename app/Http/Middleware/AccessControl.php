<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Route;

class AccessControl {

    private $userAllowedRoutes = [];

    public function handle($request, Closure $next) {
        $prefix = Route::current()->getPrefix();
        $route = Route::currentRouteName();
         // print_r($route);exit;
        if (Auth::check()) {
            if (!empty($prefix)) {
                if (Auth::user()->id !== 1) {
                    foreach (accessPages(Auth::user()->id) as $page) {
                        $this->userAllowedRoutes[] = $page->page_link;
                    }
                    if (in_array($route, $this->userAllowedRoutes)) {
                        return $next($request);
                    } else {

                        if($route == 'soeDetail'){
                            if (in_array('StatementofExperience', $this->userAllowedRoutes)) {
                                return $next($request);
                            }
                        }
                        if($route == 'soeApprovalDetail'){
                            if (in_array('soeApproval', $this->userAllowedRoutes)) {
                                return $next($request);
                            }
                        }
                        if($route == 'approvalDetail'){
                            if (in_array('myApproval', $this->userAllowedRoutes)) {
                                return $next($request);
                            }
                            // if (in_array('allApproval', $this->userAllowedRoutes)) {
                            //     return $next($request);
                            // }
                        }

                        if($route == 'allApprovalDetail'){
                            if (in_array('allApproval', $this->userAllowedRoutes)) {
                                return $next($request);
                            }
                        }

                        // if(in_array('StatementofExperience', $this->userAllowedRoutes)){

                        // }
                        // if(in_array($route, $this->userAllowedRoutes)){

                        // }
                        // if(in_array($route, $this->userAllowedRoutes)){

                        // }

                        if (!empty($this->userAllowedRoutes)) {
                            return redirect()->route($this->userAllowedRoutes[0]);
                        } else {
                            return redirect()->route('restricted');
                        }
                    }
                }
            }
        }
        return $next($request);
    }

}
