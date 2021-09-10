<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('iso3');
            $table->string('numeric_code');
            $table->string('iso2');
            $table->string('phonecode');
            $table->string('capital');
            $table->string('currency');
            $table->string('currency_symbol');
            $table->string('tld');
            $table->string('native');
            $table->string('region');
            $table->string('subregion');
            $table->string('timezones');
            $table->string('translations');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('emoji');
            $table->string('emojiU');
            $table->timestamps();
            $table->string('flag');
            $table->string('wikiDataId');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
    }
}
