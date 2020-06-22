@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <form action="/customers/{{$customer->id}}" method="POST">
            @csrf
            @method('DELETE')
            <h4>
                {{$customer->name}}
                <small class="float-right">

                    <input type="submit" value="Удалить" class="btn btn-danger btn-sm" />
                </small>
            </h4>
        </form>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <p class="card-text">Телефон: {{$customer->phone}}</p>
                <p class="card-text">Email: {{$customer->email}}</p>
                <p class="card-text">Статус: {{$customer->customerStatus->title}}</p>
                <p class="card-text">Подписка: {{$customer->subscription->OriginId ?? 'Отсутствует'}}</p>
            </div>
            <div class="col">
                @if ($customer->subscription)
                <h4>
                    Подписка:
                    <small class="float-right">
                        <a href="/subscriptions/{{$customer->subscription->id}}/grab" class="btn btn-sm btn-warning">Обновить</a>
                    </small>
                </h4>
                <div>
                    OriginId: {{ $customer->subscription->OriginId ?? '-' }} <br>
                    CustomerId: {{ $customer->subscription->CustomerId ?? '-' }} <br>
                    AccountId: {{ $customer->subscription->AccountId ?? '-' }} <br>
                    Description: {{ $customer->subscription->Description ?? '-' }} <br>
                    Email: {{ $customer->subscription->Email ?? '-' }} <br>
                    Amount: {{ $customer->subscription->Amount ?? '-' }} <br>
                    CurrencyCode: {{ $customer->subscription->CurrencyCode ?? '-' }} <br>
                    Currency: {{ $customer->subscription->Currency ?? '-' }} <br>
                    RequireConfirmation: {{ $customer->subscription->RequireConfirmation ?? '-' }} <br>
                    StartDate: {{ $customer->subscription->StartDate ?? '-' }} <br>
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
                    LastTransactionDate: {{ $customer->subscription->LastTransactionDate ?? '-' }} <br>
                    LastTransactionDateIso: {{ $customer->subscription->LastTransactionDateIso ?? '-' }} <br>
                    NextTransactionDate: {{ $customer->subscription->NextTransactionDate ?? '-' }} <br>
                    NextTransactionDateIso: {{ $customer->subscription->NextTransactionDateIso ?? '-' }} <br>
                    FailoverSchemeId: {{ $customer->subscription->FailoverSchemeId ?? '-' }} <br>
                </div>
                @endif
            </div>
        </div>

        <a href="/customers">К списку</a>
    </div>
</div>
@endsection