<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('testimonials', function (Blueprint $table) {
            // Check if 'order' column exists (production) and rename it
            if (Schema::hasColumn('testimonials', 'order') && !Schema::hasColumn('testimonials', 'sort_order')) {
                $table->renameColumn('order', 'sort_order');
            }

            // Add new columns if they don't exist
            if (!Schema::hasColumn('testimonials', 'title')) {
                $table->json('title')->nullable()->after('client_name');
            }

            if (!Schema::hasColumn('testimonials', 'customer_since')) {
                $table->string('customer_since')->nullable()->after('title');
            }

            if (!Schema::hasColumn('testimonials', 'consulting_rating')) {
                $table->tinyInteger('consulting_rating')->unsigned()->nullable()->after('rating');
            }

            if (!Schema::hasColumn('testimonials', 'satisfaction_rating')) {
                $table->tinyInteger('satisfaction_rating')->unsigned()->nullable()->after('consulting_rating');
            }

            if (!Schema::hasColumn('testimonials', 'service_rating')) {
                $table->tinyInteger('service_rating')->unsigned()->nullable()->after('satisfaction_rating');
            }

            if (!Schema::hasColumn('testimonials', 'status')) {
                $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->after('is_active');
            }

            if (!Schema::hasColumn('testimonials', 'submitted_at')) {
                $table->timestamp('submitted_at')->nullable()->after('status');
            }
        });

        // Update existing data: set status to 'approved' for existing testimonials
        DB::table('testimonials')->update(['status' => 'approved']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('testimonials', function (Blueprint $table) {
            // Reverse the changes
            if (Schema::hasColumn('testimonials', 'sort_order') && !Schema::hasColumn('testimonials', 'order')) {
                $table->renameColumn('sort_order', 'order');
            }

            // Drop added columns
            $columnsToRemove = ['title', 'customer_since', 'consulting_rating', 'satisfaction_rating', 'service_rating', 'status', 'submitted_at'];
            foreach ($columnsToRemove as $column) {
                if (Schema::hasColumn('testimonials', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
