<?php

use App\Models\Contact;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->index();
            $table->string(Contact::SCHEMA_EMAIL);
            $table->string(Contact::SCHEMA_FIRST_NAME)->nullable();
            $table->string(Contact::SCHEMA_LAST_NAME)->nullable();
            $table->string(Contact::SCHEMA_PHONE)->nullable();
            $table->boolean(Contact::SCHEMA_BOUNCED)->default(false);
            $table->integer(Contact::PIVOT_BRAND_ID)->nullable();
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
        Schema::dropIfExists('contacts');
    }
}
