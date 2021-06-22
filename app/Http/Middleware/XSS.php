<?php

namespace App\Http\Middleware;

use Closure;

class XSS
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

        if($request->method() == 'POST' || $request->method() == 'PUT')
        {
            $input = $request->all();
            array_walk_recursive($input, function(&$input) {
                if ($input) {
                    $input  = clean($input);
                }
                
            });
            $request->merge($input);
            return $next($request);

        }else{
            $input = $request->all();
            array_walk_recursive($input, function(&$input) {
                if ($input) {
                    $input = htmlentities(clean($input));
                }
            });
            $request->merge($input);
            return $next($request);
        }

        return $next($request);

    }
}
