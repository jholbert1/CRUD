<?php

use Illuminate\Database\Seeder;

class Cities extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = array(
            array('id' => 1,'state_id' => 1,'code' => 'VE','name' => "Caracas"),
            array('id' => 2,'state_id' => 2,'code' => 'AR','name' => "Buenos Aires 2"),
            array('id' => 3,'state_id' => 3,'code' => 'BR','name' => "Brasilia 2"),
            array('id' => 4,'state_id' => 4,'code' => 'CO','name' => "Bogota 2")
        );
            DB::table('cities')->insert($cities);
    }
}
