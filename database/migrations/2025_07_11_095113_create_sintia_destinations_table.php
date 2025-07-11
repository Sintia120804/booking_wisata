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
        Schema::create('sintia_destinations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('sintia_categories')->onDelete('cascade');
            $table->string('name');
            $table->string('location');
            $table->text('description');
            $table->integer('price');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sintia_destinations');
    }
};
