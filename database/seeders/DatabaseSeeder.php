<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Hash;
use DB;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'superadmin@gmail.com',
            'role' => 1,
            'password' => Hash::make('123'),
        ]);

        $faker = Faker::create('lt_LT');
        $authors = 10;
        $publishers = 10;
        $books = 80;

        foreach(range(1, $authors) as $_) {
            DB::table('authors')->insert([
                'name' => $faker->firstName(),
                'surname' => $faker->lastName(),
                'portret' => $faker->imageUrl(100, 150),
            ]);
        }

        foreach(range(1, $publishers) as $_) {
            DB::table('publishers')->insert([
                'title' => $faker->company(),
            ]);
        }

        foreach(range(1, $books) as $_) {
            DB::table('books')->insert([
                'title' => str_replace(['.', "'", '"', '(', ')'], '', $faker->realText(rand(10, 45))),
                'isbn' => $faker->isbn13(),
                'pages' => rand(22, 888),
                'about' => $faker->realText(400, 4),
                'author_id' => rand(1, $authors),
                'publisher_id' => rand(1, $publishers),
            ]);
        }

    }
}
