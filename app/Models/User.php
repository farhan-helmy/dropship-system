<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Cashier\Billable;
use DateTimeInterface;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, Notifiable, Billable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'nric',
        'phone_no'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function routeNotificationForSns($notification)
    {
        return $this->phone_no;
    }
}
