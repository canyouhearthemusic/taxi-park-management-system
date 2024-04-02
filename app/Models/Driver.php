<?php

namespace App\Models;

use App\Models\Scopes\CityScope;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Driver extends Model
{
    use HasFactory;
    use Searchable;

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
