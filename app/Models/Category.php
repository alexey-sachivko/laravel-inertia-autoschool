<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function topics() {
        return $this->hasMany(Topic::class);
    }

    public function groups() {
        return $this->hasMany(Group::class);
    }
}
