<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ApiClientsGrants extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('Api_Client_Grants', function (Blueprint $table) {
        $table->unsignedBigInteger('client_id');
        $table->foreign('client_id')->references('client_id')->on('Api_Clients');
        $table->unsignedBigInteger('install_id');
        $table->foreign('install_id')->references('install_id')->on('Api_Install_Perm');
        $table->id('branch_id');
        $table->boolean('active');
        $table->text('perms');
        $table->timestamps();
        // Pas de branche id car branch id est un string !
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
        Schema::dropIfExists('Api_Client_Grants');
    }
}
