<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable=['location','about','user_id','address'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

