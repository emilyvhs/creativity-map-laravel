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
        Schema::create('pending_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200);
            $table->string('address');
            $table->string('city');
            $table->string('postcode')->nullable();
            $table->integer('activity1');
            $table->integer('activity2')->nullable();
            $table->integer('activity3')->nullable();
            $table->string('description', 2000);
            $table->string('image')->nullable()->default('https://placehold.co/400');
            $table->string('image_alt_text')->nullable()->default('');
            $table->string('contact_name');
            $table->string('contact_email');
            $table->float('lat')->nullable();
            $table->float('lng')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pending_groups');
    }
};
