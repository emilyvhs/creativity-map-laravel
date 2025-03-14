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
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('address');
            $table->string('city');
            $table->string('postcode', 8);
            $table->integer('activity1');
            $table->integer('activity2')->nullable();
            $table->integer('activity3')->nullable();
            $table->string('description', 1000);
            $table->string('image')->nullable();
            $table->string('contact_name');
            $table->string('contact_email');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groups');
    }
};
