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
        Schema::create('tasks', function (Blueprint $table) {
          $table->id()->autoIncrement();
          $table->string('title');
          $table->longText('description')->nullable();
          $table->timestamp('due_date')->nullable();
          $table->string('rate'); // kung magkano yung project
          $table->string('priority'); //low and high ang options
          $table->string('image_path')->nullable(); // for uploading ng image
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
