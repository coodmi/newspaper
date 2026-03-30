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
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); // Uploader
            $table->string('disk'); // e.g., 'public', 's3'
            $table->string('directory');
            $table->string('filename');
            $table->string('extension');
            $table->string('mime_type');
            $table->unsignedInteger('size'); // in bytes
            $table->string('alt_text')->nullable();
            $table->string('caption')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};