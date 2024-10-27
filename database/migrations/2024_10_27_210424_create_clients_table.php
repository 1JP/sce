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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('name');
            $table->string('street', 100);
            $table->string('number', 45);
            $table->string('locality', 45);
            $table->string('city', 45);
            $table->string('region_code', 45);
            $table->string('postal_code', 45);
            $table->string('complement', 100)->nullable();
            $table->date('birth_date');
            $table->string('cpf', 11)->unique();
            $table->string('country', 2)->default('55');
            $table->string('area', 2);
            $table->string('phone', 10);
            $table->string('customer_id', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
