<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'No name Author',
                'email' => 'noname@non.ru' ,
                'password' => bcrypt('111111'),
            ],
            [
                'name' => 'Author',
                'email' => 'author@site.ru' ,
                'password' => bcrypt('222222'),
            ],
        ];
        
        Db::table('users')->insert($data);
    }
}
