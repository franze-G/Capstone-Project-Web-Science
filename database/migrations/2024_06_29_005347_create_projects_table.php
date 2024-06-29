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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('description')->nullable();
            $table->timestamp('due_date')->nullable();
            $table->string('status');
            $table->string('image_path')->nullable(); // for uploading ng image
            $table->foreignId('created_by')->constrained('users'); // kung sino gumawa nung project
            $table->foreignId('updated_by')->constrained('users'); // kung sino nag update ng project
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
