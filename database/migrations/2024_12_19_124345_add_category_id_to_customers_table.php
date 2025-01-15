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
        Schema::table('customers', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('customer_categories')->onDelete('set null');
            //$table->foreign('source_id')->references('id')->on('sources')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            //$table->dropForeign(['category_id']);
            //$table->dropColumn('category_id');
        });
    }
};
