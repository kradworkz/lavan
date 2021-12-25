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
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Balagunan'
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Bucana'
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Bulacan'
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Candiz'
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Datu Sailela'
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Dionisio Riconalla'
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Jose P. Brillantes Sr. (Old Lituban)'
            ),

            8 => 
            array (
                'id' => 9,
                'name' => 'Latabon'
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Makiang'
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Malambuhangin'
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Malipot'
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'Manaol'
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'Mateo Francisco'
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'Matiag'
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'New Libutan'
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'Pangian',
            ),
            
            17 => 
            array (
                'id' => 18,
                'name' => 'Pisawak'
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'Poblacion'
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'S. Cabral'
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'Santa Maria',
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'Siay'
            ),
            22 =>
            array (
                'id' => 23,
                'name' => 'Suhaile Arabi'
            ),
            23 =>
            array (
                'id' => 24,
                'name' => 'Tabayo'
            ),
            24 =>
            array (
                'id' => 25,
                'name' => 'Tagaytay'
            ),
            25 =>
            array (
                'id' => 26,
                'name' => 'Tibangao'
            )
        ));
        
        
    }
}