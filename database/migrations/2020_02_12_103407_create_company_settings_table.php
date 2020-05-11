<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanySettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_settings', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('logo')->nullable();
            $table->string('icon')->nullable();
            $table->string('phone');
            $table->string('invoice_prefix');
            $table->string('city');
            $table->string('zip_code');
            $table->string('country');
            $table->string('postal_address');
            $table->string('bank_details')->nullable();
            $table->boolean('default_company')->default(1);
            $table->string('mail_from_email')->nullable();
            $table->string('mail_from_name')->nullable();
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
        Schema::dropIfExists('company_settings');
    }
}
