<?php

use App\Models\Container;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContainerContainerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('container_container', function (Blueprint $table) {
            $table->unsignedBigInteger(Container::PIVOT_CONTAINER_ID);
            $table->unsignedBigInteger(Container::PIVOT_CONNECTED_ID);

            $table->foreign(Container::PIVOT_CONTAINER_ID)->references('id')->on('containers')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(Container::PIVOT_CONNECTED_ID)->references('id')->on('containers')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary([Container::PIVOT_CONTAINER_ID, Container::PIVOT_CONNECTED_ID]);
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
        Schema::dropIfExists('container_container');
    }
}
