<?php
//my middelware to send acces token in headers, works only with manual Token input. Curently not used. Cuttently Token is sent in headers in ajax(vue)
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class AccessTokenMiddleware
{
 

   /**
    * Handle an incoming request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Closure  $next
    * @return mixed
    */
   public function handle(Request $request, Closure $next)
   {    
        //dd($request->user());
        //dd(\Auth::user());
        //dd(auth('api')->user());
        //dd(auth()->user()->id);
        //dd($request);
        //YHEt7CNf1SBmQs6JbTPf7qMK8FgnynI5SiPmyJELrbAO61heKy0eKuiXrxBJ
        
        ///firstly run request to get user data
        //$response = $next($request);
        
        //here works all above variants {auth()->user()->id, etc}. But only if address it from view, not direct url
        //dd($request->user()->api_token);//!!!!
        //dd(auth('api')->user());
        
        
        
    /*   
     //construct the url to use in cURL
    $url = "http://localhost/CLEANSED_GIT_HUB/Laravel_Vue_Blog/public/api/user";

    //cURL Start-> Version for localhost and 000webhost.com, cURL is not supported on zzz.com.ua hosting

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        //CURLOPT_POSTFIELDS => $dataX,//"{\n  \"customer\" : \"con\",\n  \"customerID\" : \"5108\",\n  \"customerEmail\" : \"jordi@correo.es\",\n  \"Phone\" : \"34600000000\",\n  \"Active\" : false,\n  \"AudioWelcome\" : \"https://audio.com/welcome-defecto-es.mp3\"\n\n}",
        //CURLOPT_HTTPHEADER => array(
           //"cache-control: no-cache",
           //"content-type: application/json",
           //"x-api-key: whateveriyouneedinyourheader"
        //),
        CURLOPT_FOLLOWLOCATION => false,
    ));
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //must option to Kill SSL, otherwise sets an error

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);
    dd('stop');
    if ($err) {
        dd("cURL Error #:" . $err );
    } else {
        //echo "<p> FEATURE STATUS=></p><p>Below is response from API-></p>";
        dd($response);
    }
    */
        
        /*$c = Cache::get('myGlobalApiToken');
        $d = session('myGlobalApiToken');
        dd('vv ' . config('myGlobalApiToken'));*/
        
        //session_start();
        //dd("middle " .session('myGlobalApiToken'));
        //dd(Config('myGlobalApiToken'));
        
        $tokenMine = 'YHEt7CNf1SBmQs6JbTPf7qMK8FgnynI5SiPmyJELrbAO61heKy0eKuiXrxBJ'; //auth()->user()->api_token;
        //$tokenMine = isset($request->user()->api_token) ? $request->user()->api_token : 'missing token' ;
        //dd($tokenMine);
        //$tokenMine = $request->bearerToken(); dd($tokenMine); //NW
        $request->headers->add(['Authorization' => "Bearer {$tokenMine}"]);
       
        return $next($request);
        //return $response;
   }
}