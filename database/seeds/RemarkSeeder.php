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
                'color' => 'transparent'
            ],
            [
                'title' => 'Связаться',
                'color' => '#c365f3'
            ],
            [
                'title' => "Думает",
                'color' => '#8888fb'
            ],
            [
                'title' => "Жду оплату",
                'color' => '#f79b7c'
            ],
            [
                'title' => "Отказался",
                'color' => '#f9f578'
            ]
        ];

        foreach ($remarks as $key => $remark) {
            \App\Remark::create($remark);
        }
    }
}
