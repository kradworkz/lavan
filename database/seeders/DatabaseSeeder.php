<?php

namespace Database\Seeders;

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
         
        \DB::table('users')->insert([
            'email' => 'admin@lavan.com',
            'password' => bcrypt('covidlavan2022'),
            'type' => 'Super Administrator',
            'is_active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'email_verified_at' => now(),
            'mobile' => '09123456789',
            'name' => 'Super Administrator',
            'gender' => 'Male',
        ]);

        \DB::table('municipalities')->insert([
            'name' => 'Siocon'
        ]);
        $this->call(BarangayTableSeeder::class);

        $this->call(FacilitiesTableSeeder::class);
        $this->call(BedsTableSeeder::class);
        $this->call(DropdownsTableSeeder::class);
    }
}
