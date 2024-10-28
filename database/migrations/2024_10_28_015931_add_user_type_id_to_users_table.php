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
            $table->string('last_name')->after('id')->nullable();
            $table->string('first_name')->after('id')->nullable();
            $table->foreignId('user_type_id')->nullable()->constrained('user_types');
            $table->string('password')->nullable()->change();

            $table->dropColumn('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['first_name', 'last_name', 'user_type_id']);
            $table->string('password')->nullable(false)->change();
            $table->string('name');
        });
    }
};
