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
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('has_tax')->default(false)->comment('تفعيل الضريبة');
            $table->enum('tax_type', ['percentage', 'fixed'])->nullable()->comment('نوع الضريبة: نسبة مئوية أو مبلغ ثابت');
            $table->decimal('tax_value', 8, 2)->nullable()->comment('قيمة الضريبة');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['has_tax', 'tax_type', 'tax_value']);
        });
    }
};
