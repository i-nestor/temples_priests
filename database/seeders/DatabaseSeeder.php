<?php

namespace Database\Seeders;

use App\Models\Priest;
use App\Models\Temple;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     */
    public function run(): void {
        User::factory(2)->create();
        Temple::factory(12)->create();
        Priest::factory(15)->create();
        ElderFounderFactory::factory(10)->create();
    }
}
