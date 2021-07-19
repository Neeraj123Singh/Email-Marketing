<?php

use App\Models\Audience;
use App\Models\Contact;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactAudienceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_audience', function (Blueprint $table) {
            $table->unsignedBigInteger(Contact::PIVOT_AUDIENCE_ID);
            $table->unsignedBigInteger(Audience::PIVOT_CONTACT_ID);

            $table->foreign(Audience::PIVOT_CONTACT_ID)->references('id')->on('contacts')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(Contact::PIVOT_AUDIENCE_ID)->references('id')->on('audiences')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary([Contact::PIVOT_AUDIENCE_ID, Audience::PIVOT_CONTACT_ID]);
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
        Schema::dropIfExists('contact_audience');
    }
}
