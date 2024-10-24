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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id('id_reservation')->autoIncrement();
            $table->string('fullname');
            $table->string('phone');
            $table->string('type_chambre');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->float('total');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_chambre');
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('id_chambre')->references('id_chambre')->on('chambres')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
