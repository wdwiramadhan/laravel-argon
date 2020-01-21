<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nia');
            $table->string('name');
            $table->enum('gender', ['male', 'female']);
            $table->string('place_of_birth');
            $table->date('date_of_birth');
            $table->string('city');
            $table->string('districts');
            $table->string('village');
            $table->string('address');
            $table->string('generation');
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->enum('type', ['mataair', 'kartini']);
            $table->string('photo_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
