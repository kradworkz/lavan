<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'email' => 'admin@lavan.com',
                'email_verified_at' => '2022-03-11 17:47:38',
                'mobile' => '09123456789',
                'name' => 'Super Administrator',
                'gender' => 'Male',
                'password' => '$2y$10$7.r71DmoaBqgbDzk08ncBOmnz2uU7rDAlxjITJC7bfpp89IShg.PW',
                'type' => 'Super Administrator',
                'is_active' => 1,
                'welcome_valid_until' => NULL,
                'municipality_id' => NULL,
                'remember_token' => NULL,
                'created_at' => '2022-03-11 17:47:38',
                'updated_at' => '2022-03-11 17:47:38',
            ),
            1 => 
            array (
                'id' => 2,
                'email' => 'adminsiocon@yahoo.com',
                'email_verified_at' => NULL,
                'mobile' => '09123456780',
                'name' => 'admin siocon',
                'gender' => 'Male',
                'password' => '$2y$10$ZDiBsa4jsPsiKg9G/R0Fw.65fyKDsjliUzGa4rrFWowujpygR86dG',
                'type' => 'Administrator',
                'is_active' => 0,
                'welcome_valid_until' => NULL,
                'municipality_id' => 1,
                'remember_token' => NULL,
                'created_at' => '2022-03-11 17:50:00',
                'updated_at' => '2022-03-11 17:50:00',
            ),
            2 => 
            array (
                'id' => 3,
                'email' => 'isosiocon@yahoo.com',
                'email_verified_at' => NULL,
                'mobile' => '09557650803',
                'name' => 'iso siocon',
                'gender' => 'Male',
                'password' => '$2y$10$Sj2ZkVMdutu4YPfftUzMQOf1YS3eTr2Knx3tDf9BtIrl3dP4RXylK',
                'type' => 'Isolation Manager',
                'is_active' => 0,
                'welcome_valid_until' => NULL,
                'municipality_id' => 1,
                'remember_token' => NULL,
                'created_at' => '2022-03-11 17:50:30',
                'updated_at' => '2022-03-11 17:50:30',
            ),
            3 => 
            array (
                'id' => 4,
                'email' => 'contactsiocon@yahoo.com',
                'email_verified_at' => NULL,
                'mobile' => '09213465789',
                'name' => 'contact siocon',
                'gender' => 'Female',
                'password' => '$2y$10$iiSu016taCsOA4AgzKud6.mvOaFEbQc01rgP0.YOdAXPQDy27b8Mm',
                'type' => 'Contact Tracer',
                'is_active' => 0,
                'welcome_valid_until' => NULL,
                'municipality_id' => 1,
                'remember_token' => NULL,
                'created_at' => '2022-03-16 22:35:45',
                'updated_at' => '2022-03-16 22:35:45',
            ),
        ));
        
        
    }
}