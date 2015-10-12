<?php

use App\Table;
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

        $colors = ['green', 'blue', 'red', 'yellow', 'orange', 'purple', 'desk', 'chalkboard'];

        foreach($colors as $color)
        {
            $table = new Table();

            $table->color = $color;
            $table->save();
        }
    }
}
