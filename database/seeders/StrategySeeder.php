<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Strategy;

class StrategySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $strategies = [
            'DESKTOP',
            'MOBILE',
        ];

        foreach ($strategies as $strategy) {
            Strategy::updateOrCreate(['name' => $strategy]);
        }
    }
}
