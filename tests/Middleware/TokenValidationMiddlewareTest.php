<?php

namespace Tests\Middleware;

use App\Http\Middleware\TokenValidationMiddleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class TokenValidationMiddlewareTest extends TestCase
{
    public function test_token_validation_middleware_success(): void
    {
        $user = $this->login();

        $token = JWTAuth::fromUser($user);

        $this->assertEquals($this->fakeToken, $token);

        $middleware = new TokenValidationMiddleware();
        $request = Request::create('/api/profile', 'GET');

        $request->setUserResolver(function () use ($user) {
            return $user;
        });

        $next = function ($req) {
            $this->assertEquals(1, $req->user()->id);

            return new Response('Passed through middleware', 200);
        };

        $response = $middleware->handle($request, $next);
        $this->assertEquals(200, $response->getStatusCode());
    }
}
