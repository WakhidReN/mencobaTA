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
        Schema::disableForeignKeyConstraints();

        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ["AA","AO","LL","AR","DO","N"]);
            $table->string('marketing_name');
            $table->string('phone_number');
            $table->float('weekday_rate');
            $table->float('weekend_rate');
            $table->float('high_season_rate');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinations');
    }
};
