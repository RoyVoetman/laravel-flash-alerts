<?php

namespace RoyVoetman\LaravelFlashAlerts\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;

/**
 * Class FlashAlerts
 *
 * @package App\Http\Middleware
 */
class FlashAlerts
{
    /**
     * Flash alert after request is handled.
     *
     * @param $request
     * @param  \Closure  $next
     * @param  string  $action
     * @param  string  $model
     *
     * @return mixed
     */
    public function handle($request, Closure $next, string $action, string $model)
    {
        $response = $next($request);
        
        if($this->requestWasSuccessful($response)) {
            session()->flash('alert', __("laravel-flash-alerts::alerts.$action", ['model' => $model]));
        }
    
        return $response;
    }
    
    /**
     * @param $response
     *
     * @return bool
     */
    private function requestWasSuccessful($response): bool
    {
        return is_null($response->exception) && !session()->has('warning');
    }
}
