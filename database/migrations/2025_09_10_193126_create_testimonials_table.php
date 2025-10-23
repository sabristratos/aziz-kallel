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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('client_name');
            $table->json('title')->nullable();
            $table->json('content');
            $table->tinyInteger('rating')->unsigned()->nullable();
            $table->tinyInteger('consulting_rating')->unsigned()->nullable();
            $table->tinyInteger('satisfaction_rating')->unsigned()->nullable();
            $table->tinyInteger('service_rating')->unsigned()->nullable();
            $table->string('customer_since')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamp('submitted_at')->nullable();
            $table->timestamps();

            $table->index(['is_active', 'sort_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
