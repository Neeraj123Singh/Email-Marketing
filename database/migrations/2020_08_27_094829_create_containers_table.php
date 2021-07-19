<?php

use App\Models\Container;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContainersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('containers', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->index();
            $table->integer(Container::PIVOT_BRAND_ID);
            $table->integer(Container::PIVOT_TYPE_ID);
            $table->integer(Container::PIVOT_SERVICE_ID)->nullable();
            $table->integer(Container::PIVOT_REFERENCE_ID)->nullable();
            $table->boolean(Container::SCHEMA_PUBLISH)->default(false);
            $table->boolean(Container::SCHEMA_TEMPLATE)->default(false);
            $table->boolean(Container::SCHEMA_VISIBLE)->default(false);
            $table->timestamp(Container::SCHEMA_PUBLISHED_AT)->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('containers');
    }
}
