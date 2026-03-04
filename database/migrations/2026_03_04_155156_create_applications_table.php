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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();

            // Relacionamento com usuários
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');

            // Relacionamento com status
            $table->foreignId('status_id')
                  ->constrained('statuses')
                  ->onDelete('cascade');

            $table->string('company');
            $table->string('position');
            $table->string('location')->nullable();
            $table->string('type')->nullable(); // Remoto, Híbrido...
            $table->decimal('salary', 10, 2)->nullable();
            $table->date('applied_at');
            $table->string('job_url')->nullable();
            $table->text('notes')->nullable();
            $table->string('cv_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
