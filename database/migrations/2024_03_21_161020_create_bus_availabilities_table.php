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

        Schema::create('bus_availabilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bus_id')->constrained()->cascadeOnDelete();
            $table->enum('status', ["Available","Booked","Cancel"]);
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->enum('payment_status', ["Booked - DP","Booked - Non DP","Cancel"]);
            $table->dateTime('payment_date');
            $table->float('total_payment');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bus_availabilities');
    }
};
