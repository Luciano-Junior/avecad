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
        Schema::table('associates', function (Blueprint $table) {
            $table->unsignedBigInteger('category_associate_id')->nullable();

            $table->foreign('category_associate_id')->references('id')->on('category_associate');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('associates', function (Blueprint $table) {
            //
        });
    }
};
