<?php

namespace Database\Seeders;

use App\Models\DiscountSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiscountSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $ds = new DiscountSetting();
        $ds->save();
    }
}
