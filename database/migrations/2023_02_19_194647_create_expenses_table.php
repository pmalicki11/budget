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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('receiver_id');
            $table->string('description')->nullable();
            $table->string('type');
            $table->integer('payment_month');
            $table->integer('payment_year');
            $table->float('amount');
            $table->date('due_date')->nullable();
            $table->date('payment_date')->nullable();
            $table->boolean('is_paid')->default(false);
            $table->foreign('receiver_id')->references('id')->on('receivers')->onDelete('cascade');
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
        Schema::dropIfExists('expenses');
    }
};
