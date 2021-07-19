<?php

use App\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid')->unique()->index();
            $table->string(User::SCHEMA_FIRST_NAME)->nullable();
            $table->string(User::SCHEMA_LAST_NAME)->nullable();
            $table->string(User::SCHEMA_EMAIL)->unique();
            $table->string(User::SCHEMA_PASSWORD);
            $table->string(User::SCHEMA_PHONE)->nullable();
            $table->string(User::SCHEMA_USERNAME)->nullable();
            $table->string(User::SCHEMA_COUNTRY_CODE)->nullable();
            $table->string(User::SCHEMA_TIMEZONE)->nullable();
            $table->timestamp(User::SCHEMA_LAST_ACCESSED)->nullable();
            $table->integer(User::SCHEMA_LOGIN_COUNT)->default(0);
            $table->text(User::SCHEMA_ADDRESS_TEXT)->nullable();
            $table->string(User::SCHEMA_COUNTRY)->nullable();
            $table->string(User::SCHEMA_STATE)->nullable();
            $table->string(User::SCHEMA_CITY)->nullable();
            $table->string(User::SCHEMA_ZIP_CODE)->nullable();
            $table->boolean(User::SCHEMA_ACTIVE)->default(false);
            $table->timestamp(User::SCHEMA_EMAIL_VERIFIED_AT)->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
