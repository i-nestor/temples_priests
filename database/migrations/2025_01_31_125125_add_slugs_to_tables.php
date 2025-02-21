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
            $table->string('slug', 512)->after("shortname")->unique();
        });
        Schema::table('priests', function (Blueprint $table) {
            $table->string('slug', 512)->after("secondname")->unique();
        });
        Schema::table('elder_founders', function (Blueprint $table) {
            $table->string('slug', 512)->after("secondname")->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('temples', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
        Schema::table('priests', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
        Schema::table('elder_founders', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
