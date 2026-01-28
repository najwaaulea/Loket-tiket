<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    protected $fillable = [
        'event_category_id','name','location','event_date','price','quota'
    ];

    protected $casts = [
        'event_date' => 'datetime',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(EventCategory::class, 'event_category_id');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}

