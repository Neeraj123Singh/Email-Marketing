<?php

use App\Models\Brand;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->index();
            $table->string(Brand::SCHEMA_TITLE)->nullable();
            $table->string(Brand::SCHEMA_SLUG)->nullable();
            $table->integer(Brand::PIVOT_OWNER_ID);
            $table->integer(Brand::PIVOT_CREATED_BY)->nullable();
            $table->integer(Brand::PIVOT_UPDATED_BY)->nullable();
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
        Schema::dropIfExists('brands');
    }
}
