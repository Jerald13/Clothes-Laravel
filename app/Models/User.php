<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

// use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
// use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable implements AuthorizableContract
{
    use HasApiTokens,
        HasFactory,
        Notifiable,
        AuthenticatableTrait,
        Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ["name", "email", "phone_number", "password"];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ["password", "remember_token"];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        "email_verified_at" => "datetime",
    ];

    /**
     * Route notifications for the Vonage channel.
     */
    public function routeNotificationForVonage(
        Notification $notification
    ): string {
        return $this->phone_number;
    }

    protected function role(): Attribute
    {
        return new Attribute(
            get: fn($value) => ["user", "editor", "admin"][$value]
        );
    }

    public function myOrder()
    {
        return $this->hasMany(Order::class);
        return $this->hasMany(Product::class);
    }
}
