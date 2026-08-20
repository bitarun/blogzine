<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureAjaxRequestMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->ajax() && !in_array($request->getRealMethod(), ['POST','PUT','DELETE'])) {
            return view('errors.404');
            //abort(404);
        }
        return $next($request);
    }
}
