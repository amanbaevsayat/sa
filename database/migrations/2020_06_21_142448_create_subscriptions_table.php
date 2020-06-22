<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('OriginId')->nullable();
            $table->string('AccountId')->nullable();
            $table->string('Description')->nullable();
            $table->string('Email')->nullable();
            $table->integer('Amount')->nullable();
            $table->integer('CurrencyCode')->nullable();
            $table->string('Currency')->nullable();
            $table->boolean('RequireConfirmation')->nullable();
            $table->string('StartDate')->nullable();
            $table->string('StartDateIso')->nullable();
            $table->integer('IntervalCode')->nullable();
            $table->string('Interval')->nullable();
            $table->integer('Period')->nullable();
            $table->string('MaxPeriods')->nullable();
            $table->string('CultureName')->nullable();
            $table->integer('StatusCode')->nullable();
            $table->string('Status')->nullable();
            $table->integer('SuccessfulTransactionsNumber')->nullable();
            $table->integer('FailedTransactionsNumber')->nullable();
            $table->string('LastTransactionDate')->nullable();
            $table->string('LastTransactionDateIso')->nullable();
            $table->string('NextTransactionDate')->nullable();
            $table->string('NextTransactionDateIso')->nullable();
            $table->string('FailoverSchemeId')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscriptions');
    }
}
