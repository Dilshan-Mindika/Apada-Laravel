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
        Schema::create('missing_people', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('age')->nullable();
            $table->string('gender')->nullable();
            $table->text('last_seen_location');
            $table->text('description')->nullable();
            $table->string('image_path')->nullable();
            $table->string('contact_name');
            $table->string('contact_phone');
            $table->enum('status', ['missing', 'found'])->default('missing');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('missing_people');
    }
};
