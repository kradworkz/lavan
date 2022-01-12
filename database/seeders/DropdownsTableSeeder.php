<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DropdownsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('dropdowns')->delete();
        
        \DB::table('dropdowns')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'active',
                'color' => 'red',
                'type' => 'Status',
                'created_at' => '2022-01-12 06:23:45',
                'updated_at' => '2022-01-12 06:23:45',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'recovered',
                'color' => 'green',
                'type' => 'Status',
                'created_at' => '2022-01-12 06:23:54',
                'updated_at' => '2022-01-12 06:23:54',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'died',
                'color' => 'gray',
                'type' => 'Status',
                'created_at' => '2022-01-12 06:24:01',
                'updated_at' => '2022-01-12 06:24:01',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'person under monitoring',
                'color' => 'red',
                'type' => 'Category',
                'created_at' => '2022-01-12 06:25:33',
                'updated_at' => '2022-01-12 06:25:33',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'person under investigation',
                'color' => 'yellow',
                'type' => 'Category',
                'created_at' => '2022-01-12 06:26:12',
                'updated_at' => '2022-01-12 06:26:12',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'local stranded individual',
                'color' => 'blue',
                'type' => 'Category',
                'created_at' => '2022-01-12 06:26:51',
                'updated_at' => '2022-01-12 06:26:51',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'returning overseas filipino',
                'color' => 'black',
                'type' => 'Category',
                'created_at' => '2022-01-12 06:27:16',
                'updated_at' => '2022-01-12 06:27:16',
            ),
        ));
        
        
    }
}