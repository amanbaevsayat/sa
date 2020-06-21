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
        factory(App\CustomerStatus::class, 5)->create()->each(function ($customerStatus) {
            $customerStatus->customers()->save(factory(App\Customer::class)->make());
        });
    }
}
