<?php

namespace App\Services;

use App\Models\Profile;
use App\Models\User;
use GuzzleHttp\Client;

class ProfileService
{
    protected $authServiceUrl;

    public function __construct(private readonly Client $client)
    {
        $this->authServiceUrl = config('services.micro-services.authentication'); // URL of the User Authentication Service
    }

    public function getUserByToken(string $token, int $userId)
    {
        return $this->client->post("{$this->authServiceUrl}/get-user-by-id-and-verify-jwt", [
            'json' => ['token' => $token, 'user_id' => $userId],
        ]);
    }

    public function getProfile(User $user): Profile
    {
        return $user->profile;
    }

    public function getProfileById(int $userId): Profile
    {
        return User::where('user_id', $userId)->firstOrFail()->profile;
    }
}
