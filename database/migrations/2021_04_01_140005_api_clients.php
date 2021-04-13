<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ApiClients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('Api_Clients', function (Blueprint $table) {
        $table->id('client_id');
        $table->text('client_name');
        $table->boolean('active');
        $table->string('client_email')->unique();
        $table->string('short_description');
        $table->string('full_description');
        $table->string('logo_url');
        $table->string('url');
        $table->string('dpo');
        $table->string('technical_contact');
        $table->string('commercial_contact');
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
        //
        Schema::dropIfExists('Api_Clients');
    }
}
