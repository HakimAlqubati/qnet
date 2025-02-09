<?php

namespace Database\Seeders;

use App\Models\Rank;
use Illuminate\Database\Seeder;

class RankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rank::insert([
            [
                'name' => 'Bronze',
                'level' => 1,
                'minimum_points' => 0,
                'benefits' => json_encode(['Basic discounts', 'Beginner offers']),
            ],
            [
                'name' => 'Silver',
                'level' => 2,
                'minimum_points' => 500,
                'benefits' => json_encode(['10% discounts', 'Limited free shipping', 'Monthly coupons']),
            ],
            [
                'name' => 'Gold',
                'level' => 3,
                'minimum_points' => 1500,
                'benefits' => json_encode(['15% discounts', 'Unlimited free shipping', 'Special deals']),
            ],
            [
                'name' => 'Platinum',
                'level' => 4,
                'minimum_points' => 5000,
                'benefits' => json_encode(['20% discounts', 'Exclusive products', 'Periodic gifts']),
            ],
            [
                'name' => 'Diamond',
                'level' => 5,
                'minimum_points' => 10000,
                'benefits' => json_encode(['25% discounts', 'VIP support', 'Early access to offers']),
            ],
        ]);
    }
}
