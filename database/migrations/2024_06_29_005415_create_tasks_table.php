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
            $table->id();
            $table->string('title');
            $table->longText('description')->nullable();
            $table->timestamp('due_date')->nullable();
            $table->string('rate'); // kung magkano yung project
            $table->string('status');
            $table->string('priority'); //low and high ang options
            $table->string('image_path')->nullable(); // for uploading ng image
            $table->foreignId('assigned_user_id')->constrained('users'); // kung sino gumawa nung project
            $table->foreignId('created_by')->constrained('users'); // kung sino gumawa nung project
            $table->foreignId('updated_by')->constrained('users'); // kung sino nag update ng project
            $table->foreignId('project_id')->constrained('users'); // kung sino nag update ng project
            $table->timestamps();
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
