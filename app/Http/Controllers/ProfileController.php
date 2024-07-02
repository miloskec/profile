<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Resources\ProfileResource;
use App\Services\ProfileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function __construct(protected readonly ProfileService $profileService)
    {
    }

    public function profile(ProfileRequest $request)
    {
        return new ProfileResource($this->profileService->getProfile($request->user['id']));
    }

    public function getProfileById(ProfileRequest $request, string $userId)
    {
        Log::channel('profile')->info($request->getUri());
        $response = $this->profileService->getUserByToken($request->bearerToken(), $userId);
        
        $userData = json_decode($response->getBody(), true)['data'];

        $profile = $this->profileService->getProfile($userId)
            ->setAttribute('user', $userData);

        return new ProfileResource($profile);
    }

    public function admin(Request $request) : string
    {
        return 'You can access this!';
    }
}
