<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auto extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'brand',
        'model',
        'registration_number',
        'year_of_manufacture',
        'type',
        'status',
        'user_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function students() {
        return $this->hasMany(Student::class);
    }
}
