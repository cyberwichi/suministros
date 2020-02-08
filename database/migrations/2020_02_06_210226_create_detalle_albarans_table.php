<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleAlbaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_albarans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('albaran_id');
            $table->bigInteger('article_id');
            $table->integer('cantidad');
            $table->double('precio', 5, 2);
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
        Schema::dropIfExists('detalle_albarans');
    }
}
