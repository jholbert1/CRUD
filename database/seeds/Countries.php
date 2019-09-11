<?php

use Illuminate\Database\Seeder;

class Countries extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = array(
            array('id' => 1,'code' => 'VE','name' => "Venezuela"),
            array('id' => 2,'code' => 'AR','name' => "Argentina"),
            array('id' => 3,'code' => 'BR','name' => "Brasil"),
            array('id' => 4,'code' => 'CO','name' => "Colombia"),
        );
            DB::table('countries')->insert($countries);
    }
}
