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
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('reporter_id');
            $table->string('title', 255)->nullable();
            $table->text('description')->nullable();
            $table->enum('priority', ['High', 'Medium', 'Low']);
            $table->enum('status', ['Pending', 'On Hold', 'In Progress', 'To Review', 'In Testing', 'Completed']);
            $table->timestamps();
            $table->softDeletes();

            $table->index('title');
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
