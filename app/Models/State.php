<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class State extends Model
{
    protected $table = 'loc_state';

    protected $fillable = ['name', 'short_name', 'country_id'];

    public $timestamps = false;
    
    // Relationships
    public function country() : BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id', 'country_id');
    }
}
