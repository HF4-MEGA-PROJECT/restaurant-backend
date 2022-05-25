<?php

use App\Enums\OrderProductStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('order_products', function (Blueprint $table) {
            $table->enum('status', [OrderProductStatus::ORDERED->value, OrderProductStatus::IN_PROGRESS->value, OrderProductStatus::DELIVERABLE->value])->default('ordered')->after('price_at_purchase');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('order_products', function (Blueprint $table) {
            $table->removeColumn('status');
        });
    }
};
