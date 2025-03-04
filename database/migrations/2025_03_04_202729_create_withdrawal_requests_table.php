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
        Schema::create('withdrawal_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // المستخدم مقدم الطلب
            $table->text('notes')->nullable(); // ملاحظات اختيارية
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending'); // حالة الطلب
            $table->timestamps();
        });

        Schema::create('withdrawal_request_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('withdrawal_request_id')->constrained()->onDelete('cascade'); // يربط مع طلب السحب
            $table->decimal('amount', 10, 2); // المبلغ المطلوب سحبه
            $table->string('transaction_number')->unique(); // رقم الطلب
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withdrawal_request_details');
        Schema::dropIfExists('withdrawal_requests');
    }
};
