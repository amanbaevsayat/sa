@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <a href="/subscriptions/{{$subscription->id}}/get" class="btn btn-sm btn-warning float-right">Обновить</a>
        OriginId: {{ $subscription->OriginId ?? '-' }} <br>
        CustomerId: {{ $subscription->CustomerId ?? '-' }} <br>
        AccountId: {{ $subscription->AccountId ?? '-' }} <br>
        Description: {{ $subscription->Description ?? '-' }} <br>
        Email: {{ $subscription->Email ?? '-' }} <br>
        Amount: {{ $subscription->Amount ?? '-' }} <br>
        CurrencyCode: {{ $subscription->CurrencyCode ?? '-' }} <br>
        Currency: {{ $subscription->Currency ?? '-' }} <br>
        RequireConfirmation: {{ $subscription->RequireConfirmation ?? '-' }} <br>
        StartDateIso: {{ $subscription->StartDateIso ?? '-' }} <br>
        IntervalCode: {{ $subscription->IntervalCode ?? '-' }} <br>
        Interval: {{ $subscription->Interval ?? '-' }} <br>
        Period: {{ $subscription->Period ?? '-' }} <br>
        MaxPeriods: {{ $subscription->MaxPeriods ?? '-' }} <br>
        CultureName: {{ $subscription->CultureName ?? '-' }} <br>
        StatusCode: {{ $subscription->StatusCode ?? '-' }} <br>
        Status: {{ $subscription->Status ?? '-' }} <br>
        SuccessfulTransactionsNumber: {{ $subscription->SuccessfulTransactionsNumber ?? '-' }} <br>
        FailedTransactionsNumber: {{ $subscription->FailedTransactionsNumber ?? '-' }} <br>
        LastTransactionDateIso: {{ $subscription->LastTransactionDateIso ?? '-' }} <br>
        NextTransactionDate: {{ $subscription->NextTransactionDate ?? '-' }} <br>
        NextTransactionDateIso: {{ $subscription->NextTransactionDateIso ?? '-' }} <br>
        FailoverSchemeId: {{ $subscription->FailoverSchemeId ?? '-' }} <br>
    </div>
    <div class="card-footer">
        <a href="/subscriptions">К списку</a>
    </div>
</div>
@endsection