<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $guarded = [];

    const TYPE_BEGINER = 1;
    const TYPE_MEDIATOR = 2;
    const TYPE_EXPERT = 3;
}
