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
        Schema::create('transaksi_pengembalians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id');
            $table->foreignId('member_id');
            $table->foreignId('transaction_id');
            $table->timestamps();

            // // Define foreign key constraints
            // $table->foreign('book_id')->references('id')->on('books');
            // $table->foreign('member_id')->references('nisn')->on('members');
            // $table->foreign('transaction_id')->references('id')->on('transactions');

            // Enforce unique combination constraint
            $table->unique(['book_id', 'member_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi_pengembalians');
    }
};
