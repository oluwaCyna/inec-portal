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
        Schema::create('polling_unit', function (Blueprint $table) {
            $table->bigIncrements('uniqueid');
            $table->string('polling_unit_id');
            $table->string('ward_id');
            $table->string('lga_id');
            $table->string('uniquewardid');
            $table->string('polling_unit_number');
            $table->string('polling_unit_name');
            $table->string('polling_unit_description');
            $table->string('lat');
            $table->string('long');
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
        Schema::dropIfExists('polling_unit');
    }
};
