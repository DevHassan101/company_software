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
            $table->string('name'); // seodoses
            $table->text('description'); // 
            $table->longText('requirments'); // client requirment
            $table->unsignedBigInteger('client_id'); // client
            $table->date('started_at'); // team kam krna start =krygi
            $table->date('delivered_at'); // deliver wali din
            $table->date('delivery_date'); // client ki delivery date
            $table->unsignedBigInteger('admin_id'); // 
            $table->unsignedBigInteger('created_by'); // 
            $table->decimal('budget')->default(0); // 
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
