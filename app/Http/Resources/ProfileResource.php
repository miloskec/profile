<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

/**
 * @property int $id
 * @property string $email
 * @property string $username
 * @property string $full_name
 * @property string $address
 * @property string $phone_number
 * @property string $birthdate
 * @property string $profile_picture
 * @property string $bio
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \App\Models\User|null $user
 */
class ProfileResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // Get user data
        $userData = $this->user ? $this->user : $request->user;

        // Extract user data with prefix
        extract($userData, EXTR_PREFIX_ALL, 'user');

        return [
            'id' => $this->id,
            'email' => $user_email ?? null,
            'username' => $user_username ?? null,
            'full_name' => $user_full_name ?? null,
            'address' => $this->address,
            'phone_number' => $this->phone_number,
            'birthdate' => $this->birthdate,
            'profile_picture' => $this->profile_picture,
            'bio' => $this->bio,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'requested_from_user' => $request->user,
        ];
    }

    protected function message()
    {
        return 'Profile data retrieved successfully.';
    }
}
