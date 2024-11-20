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
        Schema::create('deslinks', function (Blueprint $table) {
            $table->foreignId('post_id')->constrained()->nullable();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('comment_id')->nullable()->constrained('comments');
            $table->timestamps();

            $table->primary(['post_id', 'user_id', 'comment_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deslinks');
    }
};
