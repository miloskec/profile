<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;
use Spatie\Activitylog\Models\Activity;

class ActivityServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Activity::saving(function (Activity $activity) {
            $request = Request::instance();
            
            $user = $request->attributes->get('authenticated_user');
            if ($user) {
                $activity->causedBy($user);
            }

            if (isset($activity->properties['attributes']['password'])) {
                $activity->properties['attributes']['password'] = '***';
            }
            if (isset($activity->properties['old']['password'])) {
                $activity->properties['old']['password'] = '***';
            }
            // Add extra data to the activity log
            $activity->properties = $activity->properties->put('extra_data', [
                'ip' => $request->ip(),
                'user_agent' => $request->header('User-Agent'),
            ]);
            //...
        });
    }
}
