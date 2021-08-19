<?php
//Middleware for Rbac check via Spatie Laravel Permission. Checks if a User has certain permisssions.

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User; 

class RbacMiddle
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
        //firstly run request to get user data
        $response = $next($request);
        
        
        
        //if has Rbac admin role (version for Zizaco/Entrust regular http web RBAC check)
        /* 
        if(!Auth::user()->hasRole('admin')){ 
            throw new \App\Exceptions\myException('You have No rbac rights to Admin Panel');
		}
        */
        
        
        //version for Zizaco/Entrust REST API RBAC check. Working
        /*
        $userX = User::where('api_token', '=', $request->bearerToken())->first(); //$request->bearerToken() is an access token sent in headers in ajax
        if(!$userX->hasRole('admin')){ 
            //throw new \App\Exceptions\myException('You have No REST API rbac rights to Admin Panel');
            return response()->json(['error' => true, 'data' => 'You have No REST API rbac rights to Admin Panel']);
        }
        */
        
        
        //version for Spatie REST API RBAC check. Working
        $userX = User::where('api_token', '=', $request->bearerToken())->first(); //$request->bearerToken() is an access token sent in headers in ajax
        if(!$userX->hasAllPermissions(['edit articles', 'delete articles',])){ 
            //throw new \App\Exceptions\myException('You have No REST API rbac rights to Admin Panel');
            return response()->json(['error' => true, 'data' => 'You have No REST API Spatie Rbac rights to Admin Panel']);
        }
        
        
        //return $next($request);
        return $response;
    }
}
