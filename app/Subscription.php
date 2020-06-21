<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = ['OriginId', 'AccountId', 'Description', 'Email', 'Amount', 'CurrencyCode', 'Currency', 'RequireConfirmation', 'StartDate', 'StartDateIso', 'IntervalCode', 'Interval', 'Period', 'MaxPeriods', 'CultureName', 'StatusCode', 'Status', 'SuccessfulTransactionsNumber', 'FailedTransactionsNumber', 'LastTransactionDate', 'LastTransactionDateIso', 'NextTransactionDate', 'NextTransactionDateIso', 'FailoverSchemeId'];

    public function customer()
    {
        return $this->hasOne('App\Customer');
    }

    public function transactions()
    {
        return $this->hasMany('App\Transaction');
    }
}
