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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable(); 
            $table->longText('requirments')->nullable();
            $table->unsignedBigInteger('client_id');
            $table->date('started_at');
            $table->timestamp('delivered_at')->nullable();
            $table->date('delivery_date');
            $table->unsignedBigInteger('admin_id')->nullable(); 
            $table->unsignedBigInteger('created_by');  
            $table->decimal('budget')->nullable();   
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
