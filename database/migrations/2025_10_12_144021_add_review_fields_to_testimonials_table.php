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
        Schema::table('testimonials', function (Blueprint $table) {
            $table->json('title')->nullable()->after('client_name');
            $table->string('customer_since')->nullable()->after('title');
            $table->tinyInteger('consulting_rating')->unsigned()->nullable()->after('rating');
            $table->tinyInteger('satisfaction_rating')->unsigned()->nullable()->after('consulting_rating');
            $table->tinyInteger('service_rating')->unsigned()->nullable()->after('satisfaction_rating');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->after('is_active');
            $table->timestamp('submitted_at')->nullable()->after('status');

            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('testimonials', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropColumn([
                'title',
                'customer_since',
                'consulting_rating',
                'satisfaction_rating',
                'service_rating',
                'status',
                'submitted_at',
            ]);
        });
    }
};
