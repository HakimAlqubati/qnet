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
            $table->unsignedBigInteger('referral_number_1')->nullable()->after('profile_photo_path');
            $table->unsignedBigInteger('referral_number_2')->nullable()->after('referral_number_1');
            $table->enum('direction', ['R', 'L'])->after('referral_number_2');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['referral_number_1', 'referral_number_2', 'direction']);
        });
    }
};
