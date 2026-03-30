<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('personal_ads', function (Blueprint $table) {
            $table->id();
            
            // এই বিজ্ঞাপনটি কোন Ad Slot-এর অন্তর্গত তা নির্ধারণ করার জন্য
            $table->foreignId('ad_slot_id')->constrained()->onDelete('cascade');
            
            $table->string('title'); // বিজ্ঞাপনটি চেনার জন্য একটি নাম
            $table->string('ad_image'); // বিজ্ঞাপনের ছবির পাথ
            $table->string('target_link'); // বিজ্ঞাপনে ক্লিক করলে যে লিঙ্কে যাবে
            
            // এই নির্দিষ্ট বিজ্ঞাপনটি চালু বা বন্ধ রাখার জন্য
            $table->boolean('is_active')->default(true);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_ads');
    }
};