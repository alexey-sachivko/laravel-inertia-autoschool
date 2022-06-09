<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $timestamps = false;

    protected $fillable = [
        'surname',
        'name',
        'third_name',
        'birthday',
        'address',
        'rank',
        'contact_info',
        'passport_info',
        'username',
        'password'
    ];

    public function autos() {
        return $this->hasMany(Auto::class);
    }

    public function groups() {
        return $this->hasMany(Group::class);
    }

    public function setPasswordAttribute($value) {
        $this->attributes['password'] = bcrypt($value);
    }

    public function getFullName() {
        return $this->surname . ' ' . $this->name . ' ' .$this->third_name;
    }
}
