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
        Schema::create('interviews', function (Blueprint $table) {
            $table->id();

            $table->foreignId('application_id')
          ->constrained()
          ->onDelete('cascade');

    $table->date('interview_date');
    $table->string('type')->nullable(); // RH, Técnico, Final
    $table->text('feedback')->nullable();
    $table->boolean('passed')->nullable();
            $table->timestamps();
        });
    }

    public function application()
{
    return $this->belongsTo(Application::class);
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interviews');
    }
};
