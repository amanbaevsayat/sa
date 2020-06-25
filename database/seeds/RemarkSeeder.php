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
            'Не отмечен', 'Связаться', "Думает", "Жду оплату"
        ];

        foreach ($remarks as $key => $remark) {
            \App\Remark::create(['title' => $remark]);
        }
    }
}
