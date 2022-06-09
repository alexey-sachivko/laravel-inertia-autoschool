<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'topic_name',
        'category_id'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function lessons() {
        return $this->hasMany(Lesson::class);
    }

    public function tests() {
        return $this->hasMany(Test::class);
    }
}
