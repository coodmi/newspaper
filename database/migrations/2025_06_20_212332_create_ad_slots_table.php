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
        Schema::create('ad_slots', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // বিজ্ঞাপনের জায়গার একটি নাম, যেমন: "Homepage Header Banner"
            $table->string('location_key')->unique(); // কোডে ব্যবহারের জন্য একটি ইউনিক কী, যেমন: "home_header"

            // বিজ্ঞাপনের ধরন নির্ধারণ করার জন্য
            $table->string('ad_type')->default('google'); // দুটি মান হতে পারে: 'google' অথবা 'personal'

            // গুগল অ্যাডের কোড রাখার জন্য
            $table->text('google_ad_code')->nullable(); // ad_type 'google' হলে এই কোডটি দেখানো হবে

            // এই স্লটটি চালু বা বন্ধ রাখার জন্য
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ad_slots');
    }
};