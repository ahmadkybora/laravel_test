<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;

class Cors
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
        // $headers = [
        //     'Access-Control-Allow-Origin' =>' *',
        //     'Access-Control-Allow-Methods'=>' POST, GET, OPTIONS, PUT, DELETE',
        //     'Access-Control-Allow-Headers'=>' Content-Type, Accept, Authorization, X-Requested-With, Cache-Control'
        // ];
        // if($request->getMethod() == "OPTIONS") {
        //     return Response::make('OK', 200, $headers);
        // }
        // $response = $next($request);
        // foreach ($headers as $key => $value) {
        //     $response->header($key, $value);
        // }
        // return $response;
        // $response = $next($request);
        
        // $response->headers->set('Access-Control-Allow-Origin', 'http://localhost:3000');
        // $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PATCH, DELETE');
        // $response->headers->set('Access-Control-Allow-Headers', 'Origin, Content-Type, Accept, Authorization, X-Requested-With, Application, X-Auth-Token, client-security-token');
        // $response->headers->set('Access-Control-Max-Age', "1000");

        // return $response;

        header("Access-Control-Allow-Origin: http://localhost:3000");

        // ALLOW OPTIONS METHOD
        $headers = [
            'Access-Control-Allow-Methods'=> 'POST, GET, OPTIONS, PUT, DELETE',
            'Access-Control-Allow-Headers'=> 'Content-Type, X-Auth-Token, Origin'
        ];
        if($request->getMethod() == "OPTIONS") {
            // The client-side application can set only headers allowed in Access-Control-Allow-Headers
            return Response::make('OK', 200, $headers);
        }

        $response = $next($request);
        foreach($headers as $key => $value)
            $response->header($key, $value);
        return $response;
    }
}
