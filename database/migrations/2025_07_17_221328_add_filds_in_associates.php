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
            $table->string('vest_number',50)->nullable()->befo;
            $table->string('occupation',100)->nullable();
            $table->date('birth_date')->nullable();
            $table->string('path_image',255)->nullable();
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
