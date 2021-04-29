<?php

use Illuminate\Database\Seeder;

class EdulevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('edulevels')->insert([
                [
                    'name'=>'SMP Sederajat',
                    'desc'=>'SMP / MTS Sederajat',
                ],[
                    'name'=>'SMA Sederajat',
                    'desc'=>'SMA / MA Sederajat',
                ]
        ]);
            
    }
}
