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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('title');
            $table->string('due_date');
            $table->string('priority_level');
            $table->string('task_category');
            $table->string('reminder_notification');
            $table->string('status');
            $table->string('description')->nullable();
            $table->string('repeat_task')->nullable();
            $table->string('repeat_task_time')->nullable();
            $table->string('attachment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
