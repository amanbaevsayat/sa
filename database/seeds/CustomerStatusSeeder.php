<?php

use Illuminate\Database\Seeder;

class CustomerStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customerStatuses = [
            'Не отмечен', 'Связаться', "Думает", "Жду оплату", "Оплачено", "Отказ"
        ];

        foreach ($customerStatuses as $key => $customerStatus) {
            \App\CustomerStatus::create(['title' => $customerStatus]);
        }
    }
}
