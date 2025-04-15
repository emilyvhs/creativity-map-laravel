<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends Model
{
    /** @use HasFactory<\Database\Factories\GroupFactory> */
    use HasFactory;

    public function firstActivities(): HasMany
    {
        return $this->hasMany(Activity::class, 'id', 'activity1');
    }

    public function secondActivities(): HasMany
    {
        return $this->hasMany(Activity::class, 'id', 'activity2');
    }

    public function thirdActivities(): HasMany
    {
        return $this->hasMany(Activity::class, 'id', 'activity3');
    }
}
