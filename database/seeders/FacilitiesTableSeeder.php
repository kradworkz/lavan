<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FacilitiesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('facilities')->delete();
        
        \DB::table('facilities')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Main Isolation',
                'address' => 'aurora village',
                'is_main' => 1,
                'barangay_id' => 19,
                'created_at' => '2022-01-10 22:05:23',
                'updated_at' => '2022-01-10 22:05:23',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Siocon Central School',
                'address' => 'siocon drive',
                'is_main' => 1,
                'barangay_id' => 19,
                'created_at' => '2022-01-10 22:06:10',
                'updated_at' => '2022-01-10 22:06:10',
            ),
            2 => 
            array (
                'id' => 3,
            'name' => 'Juliun Soriano Memorial Comprehensive Senior High School (bldg.1)',
                'address' => 'Soriano Street',
                'is_main' => 1,
                'barangay_id' => 19,
                'created_at' => '2022-01-10 22:06:49',
                'updated_at' => '2022-01-10 22:07:45',
            ),
            3 => 
            array (
                'id' => 4,
            'name' => 'Juliun Soriano Memorial Comprehensive Senior High School (bldg.2)',
                'address' => 'soriano street',
                'is_main' => 1,
                'barangay_id' => 19,
                'created_at' => '2022-01-10 22:08:22',
                'updated_at' => '2022-01-10 22:08:22',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'andres micubo jr.',
                'address' => 'no address',
                'is_main' => 0,
                'barangay_id' => 1,
                'created_at' => '2022-01-10 22:16:19',
                'updated_at' => '2022-01-10 22:16:19',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'balagunan',
                'address' => 'no address',
                'is_main' => 0,
                'barangay_id' => 2,
                'created_at' => '2022-01-10 22:17:02',
                'updated_at' => '2022-01-10 22:17:02',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'bucana',
                'address' => 'no address',
                'is_main' => 0,
                'barangay_id' => 3,
                'created_at' => '2022-01-10 22:17:30',
                'updated_at' => '2022-01-10 22:17:30',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'bulacan',
                'address' => 'no address',
                'is_main' => 0,
                'barangay_id' => 4,
                'created_at' => '2022-01-10 22:18:06',
                'updated_at' => '2022-01-10 22:18:06',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'candiz',
                'address' => 'no address',
                'is_main' => 0,
                'barangay_id' => 5,
                'created_at' => '2022-01-10 22:18:44',
                'updated_at' => '2022-01-10 22:18:44',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'datu sailela',
                'address' => 'no address',
                'is_main' => 0,
                'barangay_id' => 6,
                'created_at' => '2022-01-10 22:19:07',
                'updated_at' => '2022-01-10 22:19:07',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'dionisio riconalla',
                'address' => 'no address',
                'is_main' => 0,
                'barangay_id' => 7,
                'created_at' => '2022-01-10 22:19:29',
                'updated_at' => '2022-01-10 22:19:29',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'jose p. brillantes sr.',
                'address' => 'no address',
                'is_main' => 0,
                'barangay_id' => 8,
                'created_at' => '2022-01-10 22:23:32',
                'updated_at' => '2022-01-10 22:23:32',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'latabon',
                'address' => 'no address',
                'is_main' => 0,
                'barangay_id' => 9,
                'created_at' => '2022-01-10 22:23:55',
                'updated_at' => '2022-01-10 22:23:55',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'makiang',
                'address' => 'no address',
                'is_main' => 0,
                'barangay_id' => 10,
                'created_at' => '2022-01-10 22:24:12',
                'updated_at' => '2022-01-10 22:24:12',
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'malambuhangin',
                'address' => 'no address',
                'is_main' => 0,
                'barangay_id' => 11,
                'created_at' => '2022-01-10 22:24:40',
                'updated_at' => '2022-01-10 22:24:40',
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'malipot',
                'address' => 'no address',
                'is_main' => 0,
                'barangay_id' => 12,
                'created_at' => '2022-01-10 22:24:50',
                'updated_at' => '2022-01-10 22:24:50',
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'manaol',
                'address' => 'no address',
                'is_main' => 0,
                'barangay_id' => 13,
                'created_at' => '2022-01-10 22:25:00',
                'updated_at' => '2022-01-10 22:25:00',
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'mateo francisco',
                'address' => 'no address',
                'is_main' => 0,
                'barangay_id' => 14,
                'created_at' => '2022-01-10 22:25:16',
                'updated_at' => '2022-01-10 22:25:16',
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'matiag',
                'address' => 'no address',
                'is_main' => 0,
                'barangay_id' => 15,
                'created_at' => '2022-01-10 22:25:26',
                'updated_at' => '2022-01-10 22:25:26',
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'new libutan',
                'address' => 'no address',
                'is_main' => 0,
                'barangay_id' => 16,
                'created_at' => '2022-01-10 22:25:39',
                'updated_at' => '2022-01-10 22:25:39',
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'pangian',
                'address' => 'no address',
                'is_main' => 0,
                'barangay_id' => 17,
                'created_at' => '2022-01-10 22:25:50',
                'updated_at' => '2022-01-10 22:25:50',
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'pisawak',
                'address' => 'no address',
                'is_main' => 0,
                'barangay_id' => 18,
                'created_at' => '2022-01-10 22:26:01',
                'updated_at' => '2022-01-10 22:26:01',
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'poblacion',
                'address' => 'no address',
                'is_main' => 0,
                'barangay_id' => 19,
                'created_at' => '2022-01-10 22:26:11',
                'updated_at' => '2022-01-10 22:26:11',
            ),
            23 => 
            array (
                'id' => 24,
                'name' => 's. cabral',
                'address' => 'no address',
                'is_main' => 0,
                'barangay_id' => 20,
                'created_at' => '2022-01-10 22:26:23',
                'updated_at' => '2022-01-10 22:26:23',
            ),
            24 => 
            array (
                'id' => 25,
                'name' => 'santa maria',
                'address' => 'no address',
                'is_main' => 0,
                'barangay_id' => 21,
                'created_at' => '2022-01-10 22:26:36',
                'updated_at' => '2022-01-10 22:26:36',
            ),
            25 => 
            array (
                'id' => 26,
                'name' => 'siay',
                'address' => 'no address',
                'is_main' => 0,
                'barangay_id' => 22,
                'created_at' => '2022-01-10 22:26:46',
                'updated_at' => '2022-01-10 22:26:46',
            ),
            26 => 
            array (
                'id' => 27,
                'name' => 'suhaile arabi',
                'address' => 'no address',
                'is_main' => 0,
                'barangay_id' => 23,
                'created_at' => '2022-01-10 22:27:05',
                'updated_at' => '2022-01-10 22:27:05',
            ),
            27 => 
            array (
                'id' => 28,
                'name' => 'tabayo',
                'address' => 'no address',
                'is_main' => 0,
                'barangay_id' => 24,
                'created_at' => '2022-01-10 22:27:14',
                'updated_at' => '2022-01-10 22:27:14',
            ),
            28 => 
            array (
                'id' => 29,
                'name' => 'tagatay',
                'address' => 'no address',
                'is_main' => 0,
                'barangay_id' => 25,
                'created_at' => '2022-01-10 22:27:23',
                'updated_at' => '2022-01-10 22:27:23',
            ),
            29 => 
            array (
                'id' => 30,
                'name' => 'tibangao',
                'address' => 'no address',
                'is_main' => 0,
                'barangay_id' => 26,
                'created_at' => '2022-01-10 22:27:32',
                'updated_at' => '2022-01-10 22:27:32',
            ),
        ));
        
        
    }
}