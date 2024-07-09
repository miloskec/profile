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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            /**
             * THIS SHOULD BE INCLUDED IN THE USER MODEL EVEN AS REDUNDANT FIELDS
             * IN THAT CASE WE DONT NEED TO MAKE EXTRA REQUEST(S) TO THE AUTH* SERVICE
             * FOR EXAMPLE: LIST OF PROFILES AND GETTING DETAILS ONE BY ONE...
             *
             * $table->string('username');
             * $table->string('full_name');
             * $table->string('email')->unique();
             *
             * BUT IN OUR CASE WE WILL USE REQUESTS TO THE AUTH* SERVICE TO GET THE USER DETAILS
             */
            $table->bigInteger('user_id')->unsigned();
            $table->string('address', 255)->nullable();
            $table->string('phone_number', 35)->nullable();
            $table->date('birthdate')->nullable();
            $table->string('profile_picture', 255)->nullable();
            $table->text('bio')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
