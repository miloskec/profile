<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

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
    use HasFactory, LogsActivity;

    protected $fillable = [
        'user_id',
        'address',
        'phone_number',
        'birthdate',
        'profile_picture',
        'bio',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the activity log options for the model.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll() // Logs all attributes
            ->logOnlyDirty()
            ->useLogName('profile')
            ->setDescriptionForEvent(fn (string $eventName) => "Profile has been {$eventName}");
    }
}
