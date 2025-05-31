<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cash_boxes', function (Blueprint $table) {
            $table->id();
            $table->string("name",255)->unique();
            $table->decimal("balance",10,2);
            $table->timestamps();
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->unsignedBigInteger('cashbox_id')->after("category_id");

            $table->foreign('cashbox_id')->references('id')->on('cash_boxes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cash_boxes');
    }
};
