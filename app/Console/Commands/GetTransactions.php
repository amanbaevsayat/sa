<?php

namespace App\Console\Commands;

use App\Http\Services\PaymentService;
use Illuminate\Console\Command;

class GetTransactions extends Command
{
    private $paymentService;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transactions:get {--dateFrom=} {--dateTo=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get transactions from payment service for date';

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
        $dateFrom = $this->option('dateFrom');
        $dateTo = $this->option('dateTo');
        try {
            $period = new \DatePeriod(
                new \DateTime($dateFrom),
                new \DateInterval('P1D'),
                new \DateTime($dateTo)
            );

            foreach ($period as $value) {
                $date = $value->format('Y-m-d');

                $this->info("Getting transactions for date {$date}\n");

                $models = $this->paymentService->getTransactionsForDate($date);
                foreach ($models as $model) {

                    $this->info("Getting subscriptions for OriginId {$model['SubscriptionId']}\n");

                    $subscriptions = \App\Subscription::where('OriginId', $model['SubscriptionId'])->get();
                    foreach ($subscriptions as $subscription) {
                        if (\App\Transaction::where('PublicId', $model['PublicId'])->exists()) {
                            $transaction = \App\Transaction::where('PublicId', $model['PublicId'])->first();

                            $this->info("Updating transaction with PublicId {$model['PublicId']}\n");

                            $transaction->update($model);

                            $this->info("Updated transaction with PublicId {$model['PublicId']}\n");
                        } else {
                            $this->info("Creating transaction with PublicId {$model['PublicId']} for subscription {$subscription->OriginId}\n");

                            $subscription->transactions()->create($model);

                            $this->info("Created transaction with PublicId {$model['PublicId']} for subscription {$subscription->OriginId}\n");
                        }
                    }
                }
            }
        } catch (\Error $e) {
            $this->error($e->getMessage());
        }
    }
}
