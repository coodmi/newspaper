<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PersonalAd extends Model
{
    use HasFactory;

    protected $fillable = [
        'ad_slot_id',
        'title',
        'ad_image',
        'target_link',
        'is_active',
    ];

    /**
     * প্রতিটি Personal Ad একটি নির্দিষ্ট Ad Slot-এর অন্তর্গত।
     */
    public function adSlot(): BelongsTo
    {
        return $this->belongsTo(AdSlot::class);
    }
}