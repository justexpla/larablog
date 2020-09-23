<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
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
                'name' => 'admin',
                'label' => 'Администратор',
            ],
            [
                'name' => 'moderator',
                'label' => 'Модератор',
            ],
            [
                'name' => 'user',
                'label' => 'Пользователь',
            ],
            [
                'name' => 'banned',
                'label' => 'Забаненный',
            ],
        ];

        \DB::table('roles')->insert($data);
    }
}
