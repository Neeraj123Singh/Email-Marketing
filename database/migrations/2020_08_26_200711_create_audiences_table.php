<?php

use App\Models\Audience;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAudiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audiences', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->index();
            $table->integer(Audience::PIVOT_CONTAINER_ID)->unsigned();
            $table->string(Audience::SCHEMA_TITLE)->default('Untitled Audience');
            $table->text(Audience::SCHEMA_DESCRIPTION)->nullable();
            $table->boolean(Audience::SCHEMA_HIDDEN)->default(false);
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
        Schema::dropIfExists('audiences');
    }
}
