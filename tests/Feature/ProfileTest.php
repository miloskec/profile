<?php

namespace Tests\Feature;

use App\Models\Profile;
use App\Services\ProfileService;
use GuzzleHttp\Psr7\Response;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    public function test_return_profile_success(): void
    {
        $user = $this->login();

        $response = $this->json('GET', '/api/profile', [
            'user' => $user, // It will be converted toArray during request$user->toArray()
            'user.id' => $user->id,
        ]);
        // Assertions to check the response
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id', 'email', 'username', 'full_name', 'address', 'phone_number',
                    'birthdate', 'profile_picture', 'bio', 'created_at', 'updated_at',
                    'requested_from_user' => [
                        'id', 'email', 'username', 'full_name', 'created_at', 'updated_at',
                    ],
                ],
                'status',
                'message',
            ]);
    }

    public function test_return_specific_profile_by_id_success(): void
    {
        $user = $this->login();

        $profileServiceMock = $this->createMock(ProfileService::class);
        $profileServiceMock->method('getUserByToken')->willReturn(new Response(200, [], json_encode([
            'data' => [
                'id' => 1,
                'email' => 'miloskeckecman@gmail.com',
                'username' => 'user',
                'full_name' => 'Microservice User',
                'created_at' => '2024-07-23T17:29:32.000000Z',
                'updated_at' => '2024-07-23T17:29:32.000000Z',
            ],
            'status' => 'success',
            'message' => 'Profile data retrieved successfully.',
        ])));

        //$profileServiceMock->method('getProfileById')->willReturn(Profile::find(1));
        $profileServiceMock->method('getProfileById')
            ->willReturn(new Profile([
                'id' => 1,
                'email' => 'miloskeckecman@gmail.com',
                'username' => 'user',
                'full_name' => 'Microservice User',
                'address' => "22422 Victoria Avenue\nEast Tina, AR 00719",
                'phone_number' => '1-615-748-7244',
                'birthdate' => '1981-03-16',
                'profile_picture' => null,
                'bio' => 'Voluptatem distinctio a et ad magnam consequatur fugit.',
                'created_at' => '2024-07-23T17:29:32.000000Z',
                'updated_at' => '2024-07-23T17:29:32.000000Z',
                'requested_from_user' => [
                    'id' => 2,
                    'email' => 'miloskecman@gmail.com',
                    'username' => 'admin',
                    'full_name' => 'Microservice Admin',
                    'created_at' => '2024-07-23T17:30:12.000000Z',
                    'updated_at' => '2024-07-28T06:08:41.000000Z',
                ],
                // additional fields as needed...
            ]));
        $this->app->instance(ProfileService::class, $profileServiceMock);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$this->fakeToken,
        ])->json('GET', '/api/profile/1', [
            'user' => $user, // It will be converted toArray during request$user->toArray()
            'user.id' => $user->id,
        ]);
        // Assertions to check the response
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id', 'email', 'username', 'full_name', 'address', 'phone_number',
                    'birthdate', 'profile_picture', 'bio', 'created_at', 'updated_at',
                    'requested_from_user' => [
                        'id', 'email', 'username', 'full_name', 'created_at', 'updated_at',
                    ],
                ],
                'status',
                'message',
            ]);
    }
}
