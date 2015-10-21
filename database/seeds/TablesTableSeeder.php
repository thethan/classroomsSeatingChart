<?php

use App\Table;
use App\Seat;
use Illuminate\Database\Seeder;

class TablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colors = ['red', 'orange', 'yellow', 'green', 'blue', 'purple', 'desk', 'chalkboard'];

        foreach ($colors as $color) {
            $table = new Table();

            $table->color = $color;

            $table->save();
        }

        $tables = $table->all();


        foreach ($tables as $table) {
            $table_id = $table->id;
            for ($i = 1; $i < 7; $i++) {
                $seat = new Seat();

                $seat->number = $i;

                $seat->table_id = $table_id;

                $seat->save();
            }
        }
    }

}
