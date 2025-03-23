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
        Schema::create('dryer_vent_cleanings', function (Blueprint $table) {
            $table->bigIncrements('_id');
            $table->enum('dryer_vent_exit_point',['0-10 Feet Off the Ground','10+ Feet Off the Ground','Rooftop']);
            $table->integer('price');
            $table->unsignedBigInteger('Created_by')->default(0);
            $table->unsignedBigInteger('Updated_by')->default(0);
            $table->enum('Deleted_at',[1,0])->default(0)->comment('1 => active, 0 => inactive');
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
        Schema::dropIfExists('dryer_vent_cleanings');
    }
};
