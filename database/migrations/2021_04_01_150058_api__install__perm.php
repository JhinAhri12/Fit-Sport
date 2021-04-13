<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ApiInstallPerm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('Api_Install_Perm', function (Blueprint $table) {
        $table->id('install_id');
        $table->unsignedBigInteger('client_id');
        $table->foreign('client_id')->references('client_id')->on('Api_Clients');
        $table->string('structure');
        $table->boolean('members_read');
        $table->boolean('members_write');
        $table->boolean('members_add');
        $table->boolean('members_product_add');
        $table->boolean('members_payment_schedules_read');
        $table->boolean('members_statistiques_read');
        $table->boolean('members_subscription_read');
        $table->boolean('payment_schedules_read');
        $table->boolean('payment_schedules_write');
        $table->boolean('payment_day_read');
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
        Schema::dropIfExists('Api_Install_Perm');
    }
}
