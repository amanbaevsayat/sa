<?php

use Illuminate\Database\Seeder;

class SubscriptionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            [
                'title' => 'Прямой перевод',
                'code' => 'TTR'
            ],
            [
                'title' => 'Подписка',
                'code' => 'SUB'
            ],
        ];

        foreach ($types as $key => $type) {
            \App\SubscriptionType::create($type);
        }
    }
}
