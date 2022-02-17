<?php

namespace App\Http\Middleware;

use App\Services\Language as LanguageService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class Language
{
    public function __construct(private LanguageService $service)
    {
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $parametersRoute = Route::getCurrentRoute()?->parameters;
        if (isset($parametersRoute["lang"])) {
            $this->service->setCurrent($parametersRoute["lang"]);
        }

        return $next($request);
    }
}
