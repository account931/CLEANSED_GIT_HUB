<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use App\Http\Middleware\AccessTokenMiddleware;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        //\App\Http\Middleware\RbacMiddle::class, //my Rbac middelware
        //\App\Http\Middleware\AccessTokenMiddleware::class, //my Rest middelware

    ];





    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            
        ],

        'api' => [
            //\Illuminate\Session\Middleware\StartSession::class,
            \App\Http\Middleware\MyForceJsonResponse::class, //Force json response on every api request (as result when token is incorrect, it returns {"error":"Unauthenticated."} not redirect to /home)
            'throttle:60,1',
            'bindings',
        ],
        
        
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
		
		'role'       => \Zizaco\Entrust\Middleware\EntrustRole::class,  //my
        'permission' => \Zizaco\Entrust\Middleware\EntrustPermission::class, //my
        'ability'    => \Zizaco\Entrust\Middleware\EntrustAbility::class, //my
        'client_credentials' => \Laravel\Passport\Http\Middleware\CheckClientCredentials::class, //my for REST API
        'sendTokenMyX'       => \App\Http\Middleware\AccessTokenMiddleware::class,
        'checkX'             => \App\Http\Middleware\CheckAge::class, //just test, Delete later
        'myJsonForce'        => \App\Http\Middleware\MyForceJsonResponse::class, //Force json response on every api request
        'myRbacCheck'         => \App\Http\Middleware\RbacMiddle::class, //Force Rbac check on api request

    ];
    
    
    
     protected $commands = [
        \App\Console\Commands\GenerateAuthToken::class,
        //
    ];
}
