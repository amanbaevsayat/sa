<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Services\PaymentService;

class Init extends Command
{
    private $paymentService;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Init application';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(PaymentService $paymentService)
    {
        parent::__construct();
        $this->paymentService = $paymentService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        \Artisan::call("migrate:fresh --seed");
        $this->info("Migrations refreshed\n");


        $dateFrom = "2020-02-01";
        $dateTo = date('Y-m-d', strtotime('+1 day', strtotime(date('Y-m-d'))));
        \Artisan::call("transactions:get", [
            '--dateFrom' => $dateFrom,
            '--dateTo' => $dateTo
        ]);

        $this->info("Transactions loaded\n");

        $subscriptions = \App\Subscription::all();
        foreach ($subscriptions as  $subscription) {
            $model = $this->paymentService->getSubscription($subscription->OriginId);
            $subscription->update($model);
        }
        $this->info("Subscriptions updated\n");
    }
}
