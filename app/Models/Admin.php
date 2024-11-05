<?php

namespace App\Models;

use App\Traits\GeneralTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Database\Eloquent\SoftDeletes;


class Admin extends Authenticatable implements MustVerifyEmail
{
    use GeneralTrait,LaratrustUserTrait , HasApiTokens, HasFactory, Notifiable,SoftDeletes;
    protected $appends = ['original_active'];
    public $fillable = [
        'fcm_token',
        'full_name',
        'nick_name',
        'password',
        'country_id',
        'phone_no',
        'email',
        'email_verified_at',
        'phone_verified_at',
        'active',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    //mutators
    /**
     * Always encrypt the password when it is updated.
     *
     * @param $value
    * @return string
    */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = hashData($value);
    }
   
    public function getFilamentUserName(): string
    {
        return $this->name ?? 'Unknown User'; // Ensure it returns a string, even if 'name' is missing
    }


}
