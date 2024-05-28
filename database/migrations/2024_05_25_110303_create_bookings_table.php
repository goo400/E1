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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('color');
            

            //occurencepartagéfiled
            $table->string('Frequency')->nullable();
            $table->integer('repeateverynumber')->nullable();
            $table->string('repeatend')->nullable();
            $table->integer('repeatendoccurence')->nullable();
            $table->date('repeatenddate')->nullable();
            
            //weekly
            $table->string('weekdaysstring')->nullable();
            //monlty 
            $table->integer('dayofmonth')->nullable();

            $table->integer('NumReccurence')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
