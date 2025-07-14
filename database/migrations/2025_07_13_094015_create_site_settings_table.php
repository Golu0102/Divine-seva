<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->nullable();
            $table->string('logo')->nullable();             // Logo image path
            $table->string('footer_text')->nullable();      // Footer copyright or message
            $table->string('address')->nullable();          // Address
            $table->string('email')->nullable();            // Contact email
            $table->string('mobile')->nullable();           // Contact mobile
            $table->string('facebook')->nullable();         // Facebook URL
            $table->string('instagram')->nullable();        // Instagram URL
            $table->string('twitter')->nullable();          // Twitter URL
            $table->string('youtube')->nullable();          // YouTube URL
            $table->text('blog_1')->nullable();
            $table->text('blog_2')->nullable();
            $table->text('blog_3')->nullable();
            $table->text('blog_4')->nullable();
            $table->text('blog_5')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
