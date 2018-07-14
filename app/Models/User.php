<?php

namespace App\Models;

use App\Mail\PasswordResetMail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Mail;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'login', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sendPasswordResetNotification($token)
    {
        Mail::send(new PasswordResetMail($this->email, $token));
//        dd($token);
//        dd($this->notify(new ResetPasswordNotification($token)));
//        $this->notify(new ResetPasswordNotification($token));
    }
}
