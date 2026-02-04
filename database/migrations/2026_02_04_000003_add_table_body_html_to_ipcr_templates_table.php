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
        Schema::table('ipcr_templates', function (Blueprint $table) {
            $table->longText('table_body_html')->nullable()->after('content');
            $table->string('school_year')->nullable()->after('period');
            $table->string('semester')->nullable()->after('school_year');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ipcr_templates', function (Blueprint $table) {
            $table->dropColumn(['table_body_html', 'school_year', 'semester']);
        });
    }
};
