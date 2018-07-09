<?php

use Illuminate\Database\Seeder;
use App\Models\History;

class HistoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(History::class, 10)->create();
    }
}
