<?php

use App\Models\Internal\Email;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emails', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->index();
            $table->integer(Email::PIVOT_CONTACT_ID)->unsigned();
            $table->integer(Email::PIVOT_CAMPAIGN_ID)->nullable()->unsigned();
            $table->string(Email::SCHEMA_SUBJECT)->nullable();
            $table->mediumText(Email::SCHEMA_PREHEADER)->nullable();
            $table->longText(Email::SCHEMA_CONTENT)->nullable();
            $table->longText(Email::SCHEMA_TEXT)->nullable();
            $table->string(Email::SCHEMA_FROM_NAME)->nullable();
            $table->string(Email::SCHEMA_FROM_EMAIL)->nullable();
            $table->string(Email::SCHEMA_REPLY_TO)->nullable();
            $table->string(Email::SCHEMA_TOKEN)->nullable();
            $table->string(Email::SCHEMA_SES_MESSAGE_ID)->nullable();
            $table->longText(Email::SCHEMA_META)->nullable();
            $table->timestamp(Email::SCHEMA_SENT_ON)->nullable();
            $table->timestamp(Email::SCHEMA_OPENED_ON)->nullable();
            $table->timestamp(Email::SCHEMA_CLICKED_ON)->nullable();
            $table->enum(Email::SCHEMA_STATUS, ['not_sent' , 'queued' , 'sent', 'delivered', 'hard_bounced', 'soft_bounced']);
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
        Schema::dropIfExists('emails');
    }
}
