<?php

use Illuminate\Database\Seeder;

class States extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = array(
            array('id' => 1,'country_id' => 1,'code' => 'VE','name' => "Distrito Capital"),
            array('id' => 2,'country_id' => 2,'code' => 'AR','name' => "Buenos Aires"),
            array('id' => 3,'country_id' => 3,'code' => 'BR','name' => "Brasilia"),
            array('id' => 4,'country_id' => 4,'code' => 'CO','name' => "Bogota")
        );
            DB::table('states')->insert($states);
    }
}
