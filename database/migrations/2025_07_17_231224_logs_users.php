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
        Schema::create('logs_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('task_id')->nullable()->constrained('task')->onDelete('set null');
            $table->string('title');
            $table->enum('status', ['pendente', 'andamento', 'concluida']);
            $table->enum('status_novo', ['pendente', 'andamento', 'concluida'])->nullable();
            $table->enum('priority', ['baixa', 'media', 'alta']);
            $table->string('action');
            $table->date('due_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs_users');
    }
};
