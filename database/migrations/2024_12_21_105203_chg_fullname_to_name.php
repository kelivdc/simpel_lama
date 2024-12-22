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
        Schema::table('t_int_user', function (Blueprint $table) {
            $table->renameColumn('fullname', 'name');
            $table->renameColumn('create_date', 'created_at');
            $table->renameColumn('update_date', 'updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('t_int_user', function (Blueprint $table) {
            $table->renameColumn('name', 'fullname');
            $table->renameColumn('created_at', 'create_date');
            $table->renameColumn('updated_at', 'update_date');
        });
    }
};
