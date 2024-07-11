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
        // Check if the 'teams' table already exists before creating it
        if (!Schema::hasTable('teams')) {
            Schema::create('teams', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->index();
                $table->string('name');
                $table->boolean('personal_team');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop foreign key constraints referencing the 'teams' table
        Schema::table('team_invitations', function (Blueprint $table) {
            $table->dropForeign(['team_id']);
        });

        // Drop the 'teams' table
        Schema::dropIfExists('teams');
    }
};
