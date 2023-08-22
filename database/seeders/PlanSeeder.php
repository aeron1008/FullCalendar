<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Plan;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plans = [
            [
                'name' => 'Pretplata',
                'slug' => 'pretplata',
                'stripe_plan' => ( config('app.env') == 'production'  ? 'price_1MxtUDDZvpInnoCnCq6b161y' : 'price_1MwKguDZvpInnoCnJzCzWuUr'),
                'price' => 40,
                'description' => 'Pretplata Basic Plan'
            ]
        ];

        foreach ($plans as $plan) {
            Plan::create($plan);
        }
    }
}
