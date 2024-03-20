<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Searchable;

class City extends Model
{
    use Searchable;

    public $timestamps = false;
}
