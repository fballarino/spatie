<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Bank;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Bank::truncate();

        $this->call(SeedBanksTable::class);
    }
}
