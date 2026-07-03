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
        Schema::table('users', function (Blueprint $table) {
            $table->string('nim_nip')->nullable()->after('name');
            $table->string('study_program')->nullable()->after('nim_nip');
            $table->string('phone')->nullable()->after('study_program');
        });

        Schema::table('bookings', function (Blueprint $table) {
            $table->text('admin_notes')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['nim_nip', 'study_program', 'phone']);
        });

        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('admin_notes');
        });
    }
};
