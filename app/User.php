<?php

namespace App;

use App\Models\EducationProfile;
use App\Models\Profile;
use App\Models\WorkProfile;
use App\Traits\Friendable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use Friendable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','slug','avatar','gender','cover_photo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
    public function workProfile()
    {
        return $this->hasOne(WorkProfile::class);
    }
    public function educationProfile()
    {
        return $this->hasOne(EducationProfile::class);
    }
}
