<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('users')->insert([
            [
                'name' => "Grupo D'arc",
                'email' => 'darcautos',
                'password' => bcrypt('Darc4u70$'),
            ],

        ]);
    }
}
