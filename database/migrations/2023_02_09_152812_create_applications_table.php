<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->integer('agreement_no')->nullable();
            $table->integer('application_id')->nullable();
            $table->date('first_agreement_date')->nullable();
            $table->date('agreement_date')->nullable();
            $table->date('expire_date')->nullable();
            $table->integer('allocation_status')->nullable();
            $table->tinyInteger('status')->default(1)->comment("0=application, 1=approval, 2=agreement");
            $table->tinyInteger('save_status')->default(1)->comment("1=draft, 2=final");
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
        Schema::dropIfExists('applications');
    }
};
