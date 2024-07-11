<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamUserTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Check if the 'team_user' table does not exist before creating it
        if (!Schema::hasTable('team_user')) {
            Schema::create('team_user', function (Blueprint $table) {
                // Primary key
                $table->id();

                // Foreign keys
                $table->foreignId('team_id')->constrained()->onDelete('cascade');
                $table->foreignId('user_id')->constrained()->onDelete('cascade');

                // Additional columns
                $table->string('role')->nullable();
                $table->timestamps();

                // Unique constraint
                $table->unique(['team_id', 'user_id']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_user');
    }
}

