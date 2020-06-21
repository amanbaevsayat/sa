<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('subscription_id');
            $table->string('ReasonCode')->nullable();
            $table->string('PublicId')->nullable();
            $table->string('TerminalUrl')->nullable();
            $table->string('TransactionId')->nullable();
            $table->string('Amount')->nullable();
            $table->string('Currency')->nullable();
            $table->string('CurrencyCode')->nullable();
            $table->string('PaymentAmount')->nullable();
            $table->string('PaymentCurrency')->nullable();
            $table->string('PaymentCurrencyCode')->nullable();
            $table->string('InvoiceId')->nullable();
            $table->string('AccountId')->nullable();
            $table->string('Email')->nullable();
            $table->string('Description')->nullable();
            $table->string('CreatedDate')->nullable();
            $table->string('PayoutDate')->nullable();
            $table->string('PayoutDateIso')->nullable();
            $table->string('PayoutAmount')->nullable();
            $table->string('CreatedDateIso')->nullable();
            $table->string('AuthDate')->nullable();
            $table->string('AuthDateIso')->nullable();
            $table->string('ConfirmDate')->nullable();
            $table->string('ConfirmDateIso')->nullable();
            $table->string('AuthCode')->nullable();
            $table->string('TestMode')->nullable();
            $table->string('Rrn')->nullable();
            $table->string('OriginalTransactionId')->nullable();
            $table->string('FallBackScenarioDeclinedTransactionId')->nullable();
            $table->string('IpAddress')->nullable();
            $table->string('IpCountry')->nullable();
            $table->string('IpCity')->nullable();
            $table->string('IpRegion')->nullable();
            $table->string('IpDistrict')->nullable();
            $table->string('IpLatitude')->nullable();
            $table->string('IpLongitude')->nullable();
            $table->string('CardFirstSix')->nullable();
            $table->string('CardLastFour')->nullable();
            $table->string('CardExpDate')->nullable();
            $table->string('CardType')->nullable();
            $table->string('CardProduct')->nullable();
            $table->string('CardCategory')->nullable();
            $table->string('IssuerBankCountry')->nullable();
            $table->string('Issuer')->nullable();
            $table->string('CardTypeCode')->nullable();
            $table->string('Status')->nullable();
            $table->string('StatusCode')->nullable();
            $table->string('CultureName')->nullable();
            $table->string('Reason')->nullable();
            $table->string('CardHolderMessage')->nullable();
            $table->string('Type')->nullable();
            $table->string('Refunded')->nullable();
            $table->string('Name')->nullable();
            $table->string('Token')->nullable();
            $table->string('SubscriptionId')->nullable();
            $table->string('GatewayName')->nullable();
            $table->string('ApplePay')->nullable();
            $table->string('AndroidPay')->nullable();
            $table->string('TotalFee')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
