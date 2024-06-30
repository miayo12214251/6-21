<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Person;

class PeopleTableSeeder extends Seeder
{
    public function run()
    {
        Person::factory()->count(8)->create();
    }
}
