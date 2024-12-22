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
        Schema::table('t_customer_new', function (Blueprint $table) {
            $table->uuid('uuid')->nullable()->after('id_cn')->default(DB::raw('(gen_random_uuid())'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('t_customer_new', function (Blueprint $table) {
            $table->dropColumn('uuid');           
        });
    }
};
