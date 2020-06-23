@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        OriginId: {{ $customer->subscription->OriginId ?? '-' }} <br>
        CustomerId: {{ $customer->subscription->CustomerId ?? '-' }} <br>
        AccountId: {{ $customer->subscription->AccountId ?? '-' }} <br>
        Description: {{ $customer->subscription->Description ?? '-' }} <br>
        Email: {{ $customer->subscription->Email ?? '-' }} <br>
        Amount: {{ $customer->subscription->Amount ?? '-' }} <br>
        CurrencyCode: {{ $customer->subscription->CurrencyCode ?? '-' }} <br>
        Currency: {{ $customer->subscription->Currency ?? '-' }} <br>
        RequireConfirmation: {{ $customer->subscription->RequireConfirmation ?? '-' }} <br>
        StartDateIso: {{ $customer->subscription->StartDateIso ?? '-' }} <br>
        IntervalCode: {{ $customer->subscription->IntervalCode ?? '-' }} <br>
        Interval: {{ $customer->subscription->Interval ?? '-' }} <br>
        Period: {{ $customer->subscription->Period ?? '-' }} <br>
        MaxPeriods: {{ $customer->subscription->MaxPeriods ?? '-' }} <br>
        CultureName: {{ $customer->subscription->CultureName ?? '-' }} <br>
        StatusCode: {{ $customer->subscription->StatusCode ?? '-' }} <br>
        Status: {{ $customer->subscription->Status ?? '-' }} <br>
        SuccessfulTransactionsNumber: {{ $customer->subscription->SuccessfulTransactionsNumber ?? '-' }} <br>
        FailedTransactionsNumber: {{ $customer->subscription->FailedTransactionsNumber ?? '-' }} <br>
        LastTransactionDateIso: {{ $customer->subscription->LastTransactionDateIso ?? '-' }} <br>
        NextTransactionDate: {{ $customer->subscription->NextTransactionDate ?? '-' }} <br>
        NextTransactionDateIso: {{ $customer->subscription->NextTransactionDateIso ?? '-' }} <br>
        FailoverSchemeId: {{ $customer->subscription->FailoverSchemeId ?? '-' }} <br>
    </div>
    <div class="card-footer">
        <a href="/subscriptions">К списку</a>
    </div>
</div>
@endsection