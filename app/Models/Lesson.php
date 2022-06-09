<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function topic() {
        return $this->belongsTo(Topic::class);
    }

    public function students() {
        return $this->belongsToMany(Student::class);
    }
}
