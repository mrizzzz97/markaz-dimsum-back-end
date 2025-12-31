<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->string('invoice_code')->after('id');
            $table->string('customer_name')->nullable()->after('invoice_code');
            $table->string('payment_method')->after('customer_name');
            $table->integer('paid')->default(0)->after('total');
            $table->integer('change')->default(0)->after('paid');
            $table->foreignId('cashier_id')->after('change')->constrained('users');
        });
    }

    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn([
                'invoice_code',
                'customer_name',
                'payment_method',
                'paid',
                'change',
                'cashier_id',
            ]);
        });
    }
};
