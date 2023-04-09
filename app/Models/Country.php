<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    protected $table = 'loc_country';

    public $timestamps = false;

    // Relationships
    public function states() : HasMany
    {
        return $this->hasMany(State::class, 'country_id', 'country_id');
    }
}
