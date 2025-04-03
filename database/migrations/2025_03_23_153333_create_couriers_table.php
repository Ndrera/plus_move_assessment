<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouriersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('couriers', function (Blueprint $table) {
            $table->id();
            $table->integer('branch_id')->unsigned();
            $table->integer('package_id')->unsigned();
            $table->string('tracking_no');
            $table->string('sender_name');
            $table->string('sender_contact');
            $table->string('sender_email');
            $table->longText('sender_address');
            $table->string('sender_city');
            $table->string('sender_province');
            $table->string('sender_pin');
            $table->string('sender_country');
            $table->string('recipient_name');
            $table->string('recipient_contact');
            $table->string('recipient_email');
            $table->longText('recipient_address');
            $table->string('recipient_city');
            $table->string('recipient_province');
            $table->string('recipient_pin');
            $table->string('recipient_country');
            $table->longText('courier_desc');
            $table->string('weight');
            $table->string('length');
            $table->string('width');
            $table->string('height');
            $table->float('price', 10);
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('couriers');
    }
}
