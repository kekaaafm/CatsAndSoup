<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Value;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Value::factory(10)->create(["user" => "Syleam"]);
        Value::factory(10)->create(["user" => "Marketing"]);
    }
}
