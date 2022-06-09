<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'surname',
        'name',
        'third_name',
        'birthday',
        'address',
        'contact_info',
        'passport_info',
        'group_id',
        'auto_id'
    ];

    public function students() {
        return $this->belongsToMany(Lesson::class);
    }

    public function auto() {
        return $this->belongsTo(Auto::class);
    }

    public function tests() {
        return $this->hasMany(Test::class);
    }

    public function drivings() {
        return $this->hasMany(Driving::class);
    }

    public function group() {
        return $this->belongsTo(Group::class);
    }
}
