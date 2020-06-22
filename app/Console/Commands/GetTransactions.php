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
    protected $signature = 'transactions:get';

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
        $date = date('Y-m-d');
        $models = $this->paymentService->getTransactionsForDate($date);
        foreach ($models as $model) {
            $subscriptions = \App\Subscription::where('OriginId', $model['SubscriptionId'])->get();
            foreach ($subscriptions as $subscription) {
                if (\App\Transaction::where('PublicId', $model['PublicId'])->exists()) {
                    $transaction = \App\Transaction::where('PublicId', $model['PublicId'])->first();
                    $transaction->update($model);
                } else {
                    $subscription->transactions()->create($model);
                }
            }
        }
    }
}
