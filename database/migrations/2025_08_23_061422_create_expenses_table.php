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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount');
            $table->string('receipt')->nullable();
            $table->longText('description')->nullable();
            $table->string('paid_for')->nullable();
            $table->unsignedBigInteger('added_by');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->on('users')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->enum('type', ['utility-bill', 'asset', 'marketing', 'sale', 'domain-server', 'ai', 'refreshment', 'furniture-maintaineance', 'other','salary'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
