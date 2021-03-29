<?php

use Illuminate\Database\Seeder;
use App\Situation;

class SituationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Situation::class)->create([
            'id'  =>  1,
            'name'  =>  '１軒目',
        ]);
        factory(Situation::class)->create([
            'id'  =>  2,
            'name'  =>  '２軒目',
        ]);
        factory(Situation::class)->create([
            'id'  =>  3,
            'name'  =>  '深夜営業',
        ]);
        factory(Situation::class)->create([
            'id'  =>  4,
            'name'  =>  '個室有り',
        ]);
        factory(Situation::class)->create([
            'id'  =>  5,
            'name'  =>  '喫煙可',
        ]);
    }
}
