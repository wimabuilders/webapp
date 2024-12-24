<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('property_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('properties', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title')->nullable();
            $table->string('city')->nullable();
            $table->string('location')->nullable();
            $table->integer('bed')->nullable();
            $table->integer('bath')->nullable();
            $table->integer('sqft')->nullable();
            $table->decimal('price', 15, 2);
            $table->boolean('for_rent')->default(0);
            $table->string('property_type_id')->nullable();
            $table->year('year')->nullable();
            $table->boolean('featured')->default(0);
            $table->decimal('lat', 10, 7)->nullable();
            $table->decimal('long', 10, 7)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties', 'property_types');
    }
};
