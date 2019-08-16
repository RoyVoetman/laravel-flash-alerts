<?php

namespace RoyVoetman\LaravelFlashAlerts\Traits;

use Illuminate\Support\Arr;

/**
 * Trait FlashesAlerts
 *
 * @package App\Traits
 */
trait FlashesAlerts
{
    /**
     * @param  string  $model
     * @param  array  $except
     */
    public function registerAlertMiddleware(string $model, array $except = [])
    {
        $alertMiddlewareMap = Arr::except($this->alertMiddlewareMap(), $except);
        
        foreach ($alertMiddlewareMap as $method => $middleware) {
            $this->middleware("$middleware,$model")
                ->only($method);
        }
    }
    
    /**
     * @return array
     */
    private function alertMiddlewareMap()
    {
        return [
            'store'   => 'flash.alerts:added',
            'update'  => 'flash.alerts:updated',
            'destroy' => 'flash.alerts:deleted'
        ];
    }
}
