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
        Schema::create('goals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
          ->constrained()
          ->onDelete('cascade');

    $table->integer('month'); // 1 a 12
    $table->integer('year');
    $table->integer('target'); // Ex: 20 candidaturas
            $table->timestamps();
        });
    }


    public function user()
      {
    return $this->belongsTo(User::class);
     }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goals');
    }
};
