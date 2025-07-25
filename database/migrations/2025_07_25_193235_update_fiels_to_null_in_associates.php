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
            $table->string('surname')->nullable()->change();
            $table->string('address')->nullable()->change();
            $table->string('neighborhood')->nullable()->change();
            $table->string('identity')->nullable()->change();
            $table->string('cpf')->nullable()->change();
            $table->dateTime('admission_date')->nullable()->change();
            $table->string('contact')->nullable()->change();
            $table->string('family_contact')->nullable()->change();
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
