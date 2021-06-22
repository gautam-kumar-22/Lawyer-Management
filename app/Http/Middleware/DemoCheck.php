<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class DemoCheck
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
        if(\Illuminate\Support\Facades\Config::get('app.app_sync')){
            if($request->ajax())
            {
                switch ($request->method()) {
                    case 'PUT':
                            return $this->success([
                                'demo' =>true
                            ]);
                        break;
                    case 'DELETE':
                            return $this->success([
                                'demo' =>true
                            ]);
                            break;
                    default:
                        return $next($request);
                        break;
                }
            }else{
                switch ($request->method()) {
                    case 'PUT':
                        Toastr::warning('This Features is disabled for demo.');
                        return back();
                        break;
                    case 'DELETE':
                        Toastr::warning('This Features is disabled for demo.');
                        return back();
                            break;
                    default:
                        return $next($request);
                        break;
                    }
            }
            
        }
        return $next($request);
    }



    public function success($items = null, $status = 200) {
        $data = ['status' => 'success'];

        if ($items instanceof Arrayable) {
            $items = $items->toArray();
        }

        if ($items) {
            foreach ($items as $key => $item) {
                $data[$key] = $item;
            }
        }
        return response()->json($data, $status)->setEncodingOptions(JSON_NUMERIC_CHECK);
    }

}
