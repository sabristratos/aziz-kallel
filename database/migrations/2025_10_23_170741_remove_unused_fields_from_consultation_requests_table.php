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
        Schema::table('consultation_requests', function (Blueprint $table) {
            $table->dropColumn([
                'preferred_contact_method',
                'meeting_type',
                'preferred_dates',
                'time_preference',
                'current_situation',
                'specific_goals',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('consultation_requests', function (Blueprint $table) {
            $table->string('preferred_contact_method')->default('email')->after('phone');
            $table->string('meeting_type')->after('financial_topics');
            $table->json('preferred_dates')->nullable()->after('meeting_type');
            $table->string('time_preference')->nullable()->after('preferred_dates');
            $table->text('current_situation')->nullable()->after('time_preference');
            $table->text('specific_goals')->nullable()->after('current_situation');
        });
    }
};
