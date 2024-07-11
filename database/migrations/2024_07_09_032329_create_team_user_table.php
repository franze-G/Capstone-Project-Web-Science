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
        // Check if the 'team_user' table already exists before creating it
        if (!Schema::hasTable('team_user')) {
            Schema::create('team_user', function (Blueprint $table) {
                $table->id();
                $table->foreignId('team_id')->constrained()->onDelete('cascade');
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->string('role')->nullable();
                $table->timestamps();

                $table->unique(['team_id', 'user_id']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop foreign key constraints referencing the 'team_user' table
        Schema::table('team_user', function (Blueprint $table) {
            $table->dropForeign(['team_id']);
            $table->dropForeign(['user_id']);
        });

        // Drop the 'team_user' table
        Schema::dropIfExists('team_user');
    }
};
