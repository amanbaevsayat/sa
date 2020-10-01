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
                'title' => 'Оплачено',
                'color' => '#FFFFFF'
            ],
            [
                'title' => "Пробует",
                'color' => '#b3f7de'
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
