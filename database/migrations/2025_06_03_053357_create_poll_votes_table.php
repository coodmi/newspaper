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
        Schema::create('poll_votes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('poll_option_id');
            $table->unsignedBigInteger('user_id')->nullable(); // If voted by a registered user
            $table->ipAddress('ip_address')->nullable();
            $table->timestamps();

            $table->foreign('poll_option_id')->references('id')->on('poll_options')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // Add unique constraint based on your policy, e.g., a user can vote once per poll_option
            // or an IP can vote once per poll_option
             $table->unique(['poll_option_id', 'user_id']); // Example: user can vote once for an option
            // $table->unique(['poll_option_id', 'ip_address']); // Example: IP can vote once for an option
       
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poll_votes');
    }
};