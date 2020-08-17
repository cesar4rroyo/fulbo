<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(AdminSeeder::class);
         $this->call(PenyewaSeeder::class);
         $this->call(TempatPenyewaanSeeder::class);
         $this->call(PemesananSeeder::class);
         $this->call(FasilitasSeeder::class);
    }
}
