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
        $data = [];

        for ($i = 64; $i <= 103; $i++) {
            $data[] = [
                'commentary_id' => $i,
                'post_id' => rand(100, 120),
            ];
        }

        \DB::table('commentary_post')->insert($data);
    }
}
