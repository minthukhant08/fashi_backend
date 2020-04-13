<?php

use Illuminate\Database\Seeder;

class Admin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('admin')->insert([
        'email'         => 'admin@fashi.com',
        'password'        =>  '$2y$10$BdGCBfig2StLNqoqyFNYd.hiLrow1ELay.ungGB8VxiNrxLcx3.gi',
      ]);
    }
}
