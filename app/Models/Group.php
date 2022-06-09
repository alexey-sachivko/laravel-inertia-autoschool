<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'group_number',
        'date_start',
        'date_end',
        'description',
        'user_id',
        'category_id'
    ];

    public function students() {
        return $this->hasMany(Student::class);
    }

    public function schedules() {
        return $this->hasMany(Schedule::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
