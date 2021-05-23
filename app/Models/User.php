<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function education()
    {
        return $this->hasOne(UserEducation::class);
    }

    public function experiences()
    {
        return $this->hasMany(UserExperience::class);
    }

    public function languages()
    {
        return $this->hasMany(UserLanguage::class);
    }

    public function skills()
    {
        return $this->hasMany(UserSkill::class);
    }

    public function preference()
    {
        return $this->hasOne(UserPreference::class);
    }
}
