<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHostnamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hostnames', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fqdn');
            $table->string('protocol');
            $table->uuid('organization_id');
            $table->timestamps();

            $table->foreign('organization_id')
            ->references('id')->on('organizations')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hostnames');
    }
}
