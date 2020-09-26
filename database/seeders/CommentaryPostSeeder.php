<?php

namespace Database\Seeders;

use App\Models\Commentary;
use Illuminate\Database\Seeder;

class CommentaryPostSeeder extends Seeder
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
                'commentary_id' => Commentary::factory(1)->create(['user_id' => rand(9, 18)])->id,  //#TODO: не работает ебать
                'post_id' => rand(100, 120),
            ]
        ];

        \DB::table('commentary_post')->insert($data);
    }
}
