<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('temples', function (Blueprint $table) {
            $table->foreignId("user_id");
        });
        Schema::table('priests', function (Blueprint $table) {
            $table->foreignId("user_id");
        });
        Schema::table('elder_founders', function (Blueprint $table) {
            $table->foreignId("user_id");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('temples', function (Blueprint $table) {
            $table->dropColumn("user_id");
        });
        Schema::table('priests', function (Blueprint $table) {
            $table->dropColumn("user_id");
        });
        Schema::table('elder_founders', function (Blueprint $table) {
            $table->dropColumn("user_id");
        });
    }
};
