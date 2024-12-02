<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('transportations', function (Blueprint $table) {
        $table->string('id'); // Primary key
        $table->string('type'); // Type of transportation (e.g., bus, train)
        $table->integer('capacity'); // Number of seats/passengers
        $table->enum('status', ['active', 'inactive'])->default('active');        
        $table->timestamps(); // Created at and updated at
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transportations');
    }
};
