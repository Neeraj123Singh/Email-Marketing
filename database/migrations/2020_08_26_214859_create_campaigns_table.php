<?php

use App\Models\Container;
use App\Models\Services\Campaign;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->index();
            $table->integer(Campaign::PIVOT_BRAND_ID)->unsigned();
            $table->integer(Campaign::PIVOT_CONTAINER_ID)->unsigned();
            $table->string(Campaign::SCHEMA_TITLE)->default('Untitled Campaign');
            $table->text(Campaign::SCHEMA_SUBJECT)->nullable();
            $table->text(Campaign::SCHEMA_SLUG)->nullable();
            $table->string(Campaign::SCHEMA_FROM_NAME)->nullable();
            $table->string(Campaign::SCHEMA_FROM_EMAIL)->nullable();
            $table->string(Campaign::SCHEMA_REPLY_TO)->nullable();
            $table->integer(Campaign::SCHEMA_TEMPLATE)->nullable();
            $table->string(Campaign::SCHEMA_DESCRIPTION)->nullable();
            $table->longText(Campaign::SCHEMA_CONTENT)->nullable();
            $table->json(Campaign::SCHEMA_CONTENT_JSON)->nullable();
            $table->longText(Campaign::SCHEMA_TEXT)->nullable();
            $table->boolean(Campaign::SCHEMA_TEXT_ONLY)->default(0);
            $table->timestamp(Campaign::SCHEMA_STARTS_AT)->nullable();
            $table->timestamp(Campaign::SCHEMA_ENDS_AT)->nullable();
            $table->integer(Campaign::SCHEMA_PROGRESS)->default(0);
            $table->integer(Campaign::SCHEMA_ETA)->default(10e+7);
            $table->bigInteger(Campaign::SCHEMA_RECIPIENTS)->default(0);
            $table->bigInteger(Campaign::SCHEMA_SENT)->default(0);
            $table->bigInteger(Campaign::SCHEMA_ERROR)->default(0);
            $table->string(Campaign::SCHEMA_ALLOWED_FILES)->nullable();
            $table->enum(Campaign::SCHEMA_STATUS, ['draft', 'sent', 'scheduled', 'cancelled', 'sending']);
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
        Schema::dropIfExists('campaigns');
    }
}
