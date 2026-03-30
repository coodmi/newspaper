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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Author
            $table->unsignedBigInteger('category_id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('sub_title')->nullable();
            $table->text('summary')->nullable();
            $table->longText('content');
            $table->string('featured_image')->nullable();
            $table->string('image_caption')->nullable();
            $table->string('video_url')->nullable();
            $table->string('keywords')->nullable();
            $table->enum('status', ['draft', 'pending', 'published', 'archived'])->default('draft');
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_breaking')->default(false);
            // $table->boolean('is_slider')->default(false);
            $table->enum('is_slider', ['0', '1', '3'])->default('0');
            $table->unsignedInteger('section')->default(0);
            $table->timestamp('published_at')->nullable();
            $table->integer('view_count')->default(0);
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('poll_id')->nullable();
            $table->timestamps();
            $table->softDeletes(); // For deleted_at column

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('poll_id')->references('id')->on('polls')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};