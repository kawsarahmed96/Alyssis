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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->comment('logged-in user'); // logged-in user
            $table->string('destination', 255);
            $table->date('start_date');
            $table->date('end_date');
            $table->foreignId('purpose')->constrained('trip_perposes')->onDelete('cascade')->comment('trip purpose table data'); // assuming table name is trip_purposes
            $table->decimal('budget', 10, 2);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
