<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lga', function (Blueprint $table) {
            $table->bigIncrements('uniqueid');
            $table->string('lga_id');
            $table->string('lga_name');
            $table->string('state_id');
            $table->string('lga_description');
            $table->string('entered_by_user');
            $table->string('date_entered');
            $table->string('user_ip_address');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lga');
    }
};
