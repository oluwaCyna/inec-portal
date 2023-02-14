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
        Schema::create('announced_pu_results', function (Blueprint $table) {
            $table->bigIncrements('result_id');
            $table->string('polling_unit_uniqueid');
            $table->string('party_abbreviation');
            $table->string('party_score');
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
        Schema::dropIfExists('announced_pu_results');
    }
};
