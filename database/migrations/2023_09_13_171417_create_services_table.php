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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('service_title')->nullable();
             $table->string('service_image')->nullable();
             $table->string('service_header')->nullable();
             $table->string('service_short_description')->nullable();
             $table->string('service_list')->nullable();
             $table->timestamps();
         });
     }

     /**
      * Reverse the migrations.
      */
     public function down(): void
     {
         Schema::dropIfExists('services');
     }
 };
