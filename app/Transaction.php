<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['ReasonCode', 'PublicId', 'TerminalUrl', 'TransactionId', 'Amount', 'Currency', 'CurrencyCode', 'PaymentAmount', 'PaymentCurrency', 'PaymentCurrencyCode', 'InvoiceId', 'AccountId', 'Email', 'Description', 'CreatedDate', 'PayoutDate', 'PayoutDateIso', 'PayoutAmount', 'CreatedDateIso', 'AuthDate', 'AuthDateIso', 'ConfirmDate', 'ConfirmDateIso', 'AuthCode', 'TestMode', 'Rrn', 'OriginalTransactionId', 'FallBackScenarioDeclinedTransactionId', 'IpAddress', 'IpCountry', 'IpCity', 'IpRegion', 'IpDistrict', 'IpLatitude', 'IpLongitude', 'CardFirstSix', 'CardLastFour', 'CardExpDate', 'CardType', 'CardProduct', 'CardCategory', 'IssuerBankCountry', 'Issuer', 'CardTypeCode', 'Status', 'StatusCode', 'CultureName', 'Reason', 'CardHolderMessage', 'Type', 'Refunded', 'Name', 'Token', 'SubscriptionId', 'GatewayName', 'ApplePay', 'AndroidPay', 'TotalFee'];

    public function subscription()
    {
        return $this->belongsTo('App\Subscription');
    }
}
