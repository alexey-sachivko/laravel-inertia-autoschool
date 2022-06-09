<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'class_time',
        'day_of_week',
        'group_id'
    ];

    public function group() {
        return $this->belongsTo(Group::class);
    }
}
