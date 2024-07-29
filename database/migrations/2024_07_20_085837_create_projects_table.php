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
            $table->timestamp('due_date');
            $table->string('priority');
            $table->string('service_fee');
            $table->string('image_path')->nullable();
            $table->string('status')->default('pending');
            
            // Foreign keys
            $table->foreignId('created_by')->constrained('users');
            $table->string('user_firstname')->constrained('users');
            $table->string('user_lastname')->constrained('users');
            // $table->foreignId('updated_by')->constrained('users');
            
            $table->foreignId('assigned_id')->constrained('users');
            $table->string('assigned_firstname')->nullable();
            $table->string('assigned_lastname')->nullable();
            
            $table->timestamps(); // This will automatically create `created_at` and `updated_at`
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
