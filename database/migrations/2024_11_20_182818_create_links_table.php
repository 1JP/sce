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
        Schema::create('links', function (Blueprint $table) {
            $table->id(); // 🔥 ADICIONA ISSO

            $table->foreignId('post_id')->nullable()->constrained();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('comment_id')->nullable()->constrained('comments');

            $table->timestamps();

            $table->unique(['post_id', 'user_id', 'comment_id']); // 🔥 substitui PK composta
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('links');
    }
};
