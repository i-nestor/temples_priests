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
            $table->string('image')->nullable();
        });
        Schema::table('priests', function (Blueprint $table) {
            $table->string('image')->nullable();
        });
        Schema::table('elder_founders', function (Blueprint $table) {
            $table->string('image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('temples', function (Blueprint $table) {
            $table->dropColumn('image');
        });
        Schema::table('priests', function (Blueprint $table) {
            $table->dropColumn('image');
        });
        Schema::table('elder_founders', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
};
