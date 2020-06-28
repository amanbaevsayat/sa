<?php

use Illuminate\Database\Seeder;

class RemarkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $remarks = [
            [
                'title' => 'Не отмечен',
                'color' => '#FFFFFF'
            ],
            [
                'title' => 'Связаться',
                'color' => '#e0a4ff'
            ],
            [
                'title' => 'Думает',
                'color' => '#b3b3f7'
            ],
            [
                'title' => "Пробует",
                'color' => '#b3f7de'
            ],
            [
                'title' => "Жду оплату",
                'color' => '#ffc8b5'
            ],
            [
                'title' => "Отказался",
                'color' => '#fffcae'
            ]
        ];

        foreach ($remarks as $key => $remark) {
            \App\Remark::create($remark);
        }
    }
}
