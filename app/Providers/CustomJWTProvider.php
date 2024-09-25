<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;
use App\Models\User;

class CustomUserProvider implements UserProvider
{
    public function retrieveById($identifier)
    {
        return User::where('user_id', $identifier)->first();
    }

    public function retrieveByToken($identifier, $token)
    {
        // Implement this method if you need to retrieve users via remember token
    }

    public function updateRememberToken(UserContract $user, $token)
    {
        // Implement this method if your app uses remember tokens
    }

    public function retrieveByCredentials(array $credentials)
    {
        // Implement this if you need to retrieve users by credentials (e.g., email and password)
    }

    public function validateCredentials(UserContract $user, array $credentials)
    {
        // Implement this if you need to validate user credentials
    }

    public function rehashPasswordIfRequired(UserContract $user, array $credentials, bool $force = false): void
    {
        // Implement this if you need to rehash user passwords
    }
}
