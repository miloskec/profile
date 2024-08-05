<?php

return [
    App\Providers\AppServiceProvider::class,
    Tymon\JWTAuth\Providers\LaravelServiceProvider::class,
    App\Providers\ActivityServiceProvider::class,
    App\Providers\CustomJWTProvider::class,
];
