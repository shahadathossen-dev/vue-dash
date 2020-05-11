<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('fname');
            $table->string('lname');
            $table->string('username');
            $table->string('email')->unique();
            $table->string('avatar')->nullable();
            $table->string('phone')->nullable();
            $table->string('city')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('country')->nullable();
            $table->date('dob')->nullable();
            $table->string('postal_address')->nullable();
            $table->string('password')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->unsignedBigInteger('status_id')->default(2);
            $table->foreign('status_id')->references('id')->on('status');
            $table->rememberToken();
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
        Schema::dropIfExists('admins');
    }
}
