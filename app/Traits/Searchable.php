<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Searchable
{
    public function scopeSearchBy(Builder $builder, string $column, string $text): Builder
    {
        return $builder->where($column, 'like', '%' . $text . '%');
    }
}