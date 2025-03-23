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
        Schema::create('air_duct_cleanings', function (Blueprint $table) {
            $table->bigIncrements('_id');
            $table->enum('num_furnace',['1','2','3+']);
            $table->integer('square_footage_min');
            $table->integer('square_footage_max');
            $table->integer('furnace_loc_sidebyside');
            $table->integer('furnace_loc_different');
            $table->integer('final_price');
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
        Schema::dropIfExists('air_duct_cleanings');
    }
};
