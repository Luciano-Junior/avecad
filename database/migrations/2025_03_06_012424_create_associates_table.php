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
        Schema::create('associates', function (Blueprint $table) {
            $table->id();
            $table->string('name', length: 255);
            $table->string('surname', length: 50);
            $table->string('address');
            $table->string('neighborhood');
            $table->string('identity', length: 15)->unique();
            $table->string('cpf', length: 11)->unique();
            $table->dateTime('admission_date');
            $table->string('contact', length: 11);
            $table->string('family_contact', length: 11);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('associates');
    }
};
