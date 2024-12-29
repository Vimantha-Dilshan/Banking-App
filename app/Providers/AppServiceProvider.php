<?php

namespace App\Providers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Routing\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Knuckles\Scribe\Extracting\Shared\UrlParamsNormalizer;
use Knuckles\Scribe\Scribe;
use ReflectionClass;
use ReflectionFunctionAbstract;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        JsonResource::withoutWrapping();

        Scribe::normalizeEndpointUrlUsing(
            function (
                string $url,
                Route $route,
                ReflectionFunctionAbstract $method,
                ?ReflectionClass $controller
            ) {
                $routeNames = config('route-doc');

                foreach ($routeNames as $key => $routeName) {
                    if ($route->named($key)) {
                        foreach ($routeName as $key2 => $param) {
                            $url = Str::replace($key2, $param, $url);
                        }

                        return $url;
                    }
                }

                // use Scribe's default normalizer if we have no customization for this route.
                return UrlParamsNormalizer::normalizeParameterNamesInRouteUri($route, $method);
            }
        );
    }
}
