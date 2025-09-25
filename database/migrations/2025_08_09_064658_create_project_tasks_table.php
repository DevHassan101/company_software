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
        Schema::create('project_tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')->on('projects')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('admin_id');
            // $table->foreign('admin_id')->on('users')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->nullable();
            // $table->foreign('user_id')->on('users')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->string('title');
            $table->longText('description')->nullable();
            $table->enum('status', ['pending','ongoing','completed','rejected','failed']);
            $table->unsignedBigInteger('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_tasks');
    }
};
