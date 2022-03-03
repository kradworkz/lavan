<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BarangayTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('barangays')->delete();
        
        \DB::table('barangays')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Andres Micubo Jr.',
                'municipality_id' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Balagunan',
                'municipality_id' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Bucana',
                'municipality_id' => 1,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Bulacan',
                'municipality_id' => 1,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Candiz',
                'municipality_id' => 1,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Datu Sailela',
                'municipality_id' => 1,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Dionisio Riconalla',
                'municipality_id' => 1,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Jose P. Brillantes Sr. (Old Lituban)',
                'municipality_id' => 1,
            ),

            8 => 
            array (
                'id' => 9,
                'name' => 'Latabon',
                'municipality_id' => 1,
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Makiang',
                'municipality_id' => 1,
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Malambuhangin',
                'municipality_id' => 1,
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Malipot',
                'municipality_id' => 1,
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'Manaol',
                'municipality_id' => 1,
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'Mateo Francisco',
                'municipality_id' => 1,
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'Matiag',
                'municipality_id' => 1,
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'New Libutan',
                'municipality_id' => 1,
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'Pangian',
                'municipality_id' => 1,
            ),
            
            17 => 
            array (
                'id' => 18,
                'name' => 'Pisawak',
                'municipality_id' => 1,
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'Poblacion',
                'municipality_id' => 1,
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'S. Cabral',
                'municipality_id' => 1,
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'Santa Maria',
                'municipality_id' => 1,
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'Siay',
                'municipality_id' => 1,
            ),
            22 =>
            array (
                'id' => 23,
                'name' => 'Suhaile Arabi',
                'municipality_id' => 1,
            ),
            23 =>
            array (
                'id' => 24,
                'name' => 'Tabayo',
                'municipality_id' => 1,
            ),
            24 =>
            array (
                'id' => 25,
                'name' => 'Tagaytay',
                'municipality_id' => 1,
            ),
            25 =>
            array (
                'id' => 26,
                'name' => 'Tibangao',
                'municipality_id' => 1,
            )
        ));
        
        
    }
}