<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @SWG\Definition(
 * definition="User",
 * required={"name", "email", "password"},
 * @SWG\Property(
 * property="name",
 * type="string",
 * description="User name",
 * example="John Coner"
 * ),
 * @SWG\Property(
 * property="email",
 * type="string",
 * description="Email Address",
 * example="john.conor@terminator.com"
 * ),
 * @SWG\Property(
 * property="password",
 * type="string",
 * description="A very secure password",
 * example="tHf682k4"
 * )
 * )
 */

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relationship.
     * 
     * @var string
     */
    public function bikes() {
        return $this->hasMany('App\Bike');
    }
}
