<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class State extends Model
{
    protected $table = 'loc_state';

    
    // Relationships
    public function country() : BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id', 'country_id');
    }
}
