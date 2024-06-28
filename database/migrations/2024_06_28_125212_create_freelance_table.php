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
        Schema::create('freelance', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('mobile_number',11)->unique(); // gagawan ng function sa controller na ph number dapat if pwede. hanap rin me reference. 

            // means 11 lang accepted number since ph number gagamitin

            $table->string('position'); //iba iba naman position ng freelance so pwede kahit ano enter nila. pero ang problem is pano ang categorization since gagawa tayo filter. 
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken(); // for remember me function if ever
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('freelance');
    }
};
