<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPassword as ResetPasswordOverride;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'enterprise'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //Return the data of the linked enterprise
    public function enterprise() {
        return $this->belongsTo('App\Enterprise', 'enterprise', 'id');
    }

    public function getEnterpriseAttribute($value) {
        return ucfirst($value);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordOverride($token));
    }

}
