<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string $address
 * @property string $phone_number
 * @property string $bio
 * @property string $profile_picture
 * @property \Carbon\Carbon $birthdate
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address',
        'phone_number',
        'birthdate',
        'profile_picture',
        'bio',
    ];
}
