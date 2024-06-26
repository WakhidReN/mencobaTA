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

        Schema::create('buses', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('name', 50)->index();
            $table->enum('type', ["Big Bus","Medium","Legrest"]);
            $table->string('seat_total', 50);
            $table->string('pic', 50);
            $table->string('pic_phone');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buses');
    }
};
