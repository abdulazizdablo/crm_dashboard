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
            
            $table->foreignId('user_id')->constrained();
            $table->foreignId('client_id')->constrained();
            $table->foreignId('project_id')->constrained();
            $table->string('title',30);
            $table->date('deadline');
            $table->text('description');
            $table->enum('status',['open','in progress','pending','closed']);
        

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
