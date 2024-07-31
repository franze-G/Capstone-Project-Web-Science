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
            $table->string('rate')->nullable(); // project cost
            $table->string('status')->nullable(); // pending, in progress, completed
            $table->string('priority'); // options: low, high
            $table->string('image_path')->nullable(); // for image upload

            // Assuming these should be foreign keys to the users table
            $table->foreignId('assigned_user_id')->constrained('users');
            $table->foreignId('created_by')->constrained('users'); // client who created the task
            $table->foreignId('updated_by')->constrained('users'); // user who updated the task

            // If project_id references another table, it should be constrained as well
            $table->foreignId('project_id')->nullable(); // assuming projects table exists
            $table->string('project_name')->nullable(); // if you store project name
            $table->timestamps(); // creates both created_at and updated_at columns
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

