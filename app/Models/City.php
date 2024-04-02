<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    use Searchable;

    public $timestamps = false;

    public function workers(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function drivers(): HasMany
    {
        return $this->hasMany(Driver::class);
    }
}
