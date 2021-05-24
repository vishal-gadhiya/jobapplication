<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLanguage extends Model
{
    use HasFactory;

    protected $guarded = [];

    const IS_READ = 1;
    const IS_WRITE = 2;
    const IS_SPEAK = 3;

    const IS_CHECKED = 1;

    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
