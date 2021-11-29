<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLicensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licenses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('buyer_id');
            $table->unsignedBigInteger('software_id');
            $table->timestamp('buy_date')->nullable();
            $table->timestamp('expiry_date')->nullable();
            $table->unsignedInteger('amount');
            $table->boolean('active_status')->default(false);
            $table->string('hardware_id');
            $table->string('activation_code');
            $table->string('transaction_id');
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('buyer_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('software_id')->references('id')->on('software')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('licenses');
    }
}
