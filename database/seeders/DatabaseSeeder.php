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
        
        \DB::table('municipalities')->insert([
            'name' => 'Siocon'
        ]);
        
        \DB::table('users')->insert([
            'email' => 'admin@lavan.com',
            'password' => bcrypt('123456789'),
            'type' => 'Administrator',
            'is_active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'email_verified_at' => now(),
            'mobile' => '09123456789',
            'name' => 'Covid Lavan',
            'gender' => 'Male',
            'municipality_id' => 1,
        ]);

        $this->call(BarangayTableSeeder::class);

        $this->call(FacilitiesTableSeeder::class);
        $this->call(BedsTableSeeder::class);
        $this->call(DropdownsTableSeeder::class);
    }
}
