<?php

use App\Author;
use Illuminate\Database\Seeder;

class AuthorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('authors')->delete();

        Author::create(array(
          'name' => 'Najibu',
          'surname' => 'Nsubuga'
        ));

        Author::create(array(
          'name' => 'Lauren',
          'surname' => 'Oliver'
        ));

        Author::create(array(
          'name' => 'Dan',
          'surname' => 'Brown'
        ));
    }
}
