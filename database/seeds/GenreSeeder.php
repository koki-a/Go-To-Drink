<?php

use Illuminate\Database\Seeder;
use App\Genre;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Genre::class)->create([
            'id'  =>  1,
            'name'  =>  '居酒屋・和食',
        ]);
        factory(Genre::class)->create([
            'id'  =>  2,
            'name'  =>  '洋食',
        ]);
        factory(Genre::class)->create([
            'id'  =>  3,
            'name'  =>  '焼き鳥',
        ]);
        factory(Genre::class)->create([
            'id'  =>  4,
            'name'  =>  '中華',
        ]);
        factory(Genre::class)->create([
            'id'  =>  5,
            'name'  =>  '焼肉',
        ]);
        factory(Genre::class)->create([
            'id'  =>  6,
            'name'  =>  'Bar',
        ]);
    }
}
