<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AdSlot extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location_key',
        'ad_type',
        'google_ad_code',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * একটি Ad Slot-এর অধীনে অনেকগুলো Personal Ad থাকতে পারে।
     */
    public function personalAds(): HasMany
    {
        return $this->hasMany(PersonalAd::class);
    }
}