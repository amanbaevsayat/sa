@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-6">
        <div class="card mb-2">
            <div class="card-header">
                <form id="deleteCustomerForm" action="/customers/{{$customer->id}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <h5>
                        {{$customer->name}}
                        <small class="float-right">
                            <a href="#" id="deleteCustomerFormButton" class="btn btn-danger btn-sm">Удалить</a>
                        </small>
                    </h5>
                </form>
            </div>
            <div class="card-body">
                Телефон: {{$customer->phone}} <br>
                Email: {{$customer->email}} <br>
                Статус: {{$customer->customerStatus->title}} <br>
                Подписка: {{$customer->subscription->OriginId ?? 'Отсутствует'}} <br>

            </div>
            <div class="card-footer">
                <a href="/customers">К списку</a>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5>
                    Подписка
                    @if ($customer->subscription)
                    <small class="float-right">
                        <a href="/subscriptions/{{$customer->subscription->id}}/get" class="btn btn-sm btn-warning">Обновить</a>
                    </small>
                    @endif
                </h5>
            </div>
            <div class="card-body">
                @if ($customer->subscription)
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
                @else
                Нет данных
                @endif
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <h5>
                    Транзакции
                </h5>
            </div>
            <div class="card-body">
                @if ($customer->subscription)
                @if ($customer->subscription->transactions->isEmpty())
                Нет данных
                @else
                @foreach($customer->subscription->transactions as $transaction)
                <div class="border p-1">
                    PublicId: {{ $transaction->PublicId}} <br />
                    TerminalUrl: {{ $transaction->TerminalUrl}} <br />
                    TransactionId: {{ $transaction->TransactionId}} <br />
                    Amount: {{ $transaction->Amount}} <br />
                    Currency: {{ $transaction->Currency}} <br />
                    CurrencyCode: {{ $transaction->CurrencyCode}} <br />
                    PaymentAmount: {{ $transaction->PaymentAmount}} <br />
                    PaymentCurrency: {{ $transaction->PaymentCurrency}} <br />
                    PaymentCurrencyCode: {{ $transaction->PaymentCurrencyCode}} <br />
                    InvoiceId: {{ $transaction->InvoiceId}} <br />
                    AccountId: {{ $transaction->AccountId}} <br />
                    Email: {{ $transaction->Email}} <br />
                    Description: {{ $transaction->Description}} <br />
                    PayoutDateIso: {{ $transaction->PayoutDateIso}} <br />
                    PayoutAmount: {{ $transaction->PayoutAmount}} <br />
                    CreatedDateIso: {{ $transaction->CreatedDateIso}} <br />
                    AuthDateIso: {{ $transaction->AuthDateIso}} <br />
                    ConfirmDateIso: {{ $transaction->ConfirmDateIso}} <br />
                    AuthCode: {{ $transaction->AuthCode}} <br />
                    TestMode: {{ $transaction->TestMode}} <br />
                    Rrn: {{ $transaction->Rrn}} <br />
                    OriginalTransactionId: {{ $transaction->OriginalTransactionId}} <br />
                    FallBackScenarioDeclinedTransactionId: {{ $transaction->FallBackScenarioDeclinedTransactionId}} <br />
                    IpAddress: {{ $transaction->IpAddress}} <br />
                    IpCountry: {{ $transaction->IpCountry}} <br />
                    IpCity: {{ $transaction->IpCity}} <br />
                    IpRegion: {{ $transaction->IpRegion}} <br />
                    IpDistrict: {{ $transaction->IpDistrict}} <br />
                    IpLatitude: {{ $transaction->IpLatitude}} <br />
                    IpLongitude: {{ $transaction->IpLongitude}} <br />
                    CardFirstSix: {{ $transaction->CardFirstSix}} <br />
                    CardLastFour: {{ $transaction->CardLastFour}} <br />
                    CardExpDate: {{ $transaction->CardExpDate}} <br />
                    CardType: {{ $transaction->CardType}} <br />
                    CardProduct: {{ $transaction->CardProduct}} <br />
                    CardCategory: {{ $transaction->CardCategory}} <br />
                    IssuerBankCountry: {{ $transaction->IssuerBankCountry}} <br />
                    Issuer: {{ $transaction->Issuer}} <br />
                    CardTypeCode: {{ $transaction->CardTypeCode}} <br />
                    Status: {{ $transaction->Status}} <br />
                    StatusCode: {{ $transaction->StatusCode}} <br />
                    CultureName: {{ $transaction->CultureName}} <br />
                    Reason: {{ $transaction->Reason}} <br />
                    CardHolderMessage: {{ $transaction->CardHolderMessage}} <br />
                    Type: {{ $transaction->Type}} <br />
                    Refunded: {{ $transaction->Refunded}} <br />
                    Name: {{ $transaction->Name}} <br />
                    Token: {{ $transaction->Token}} <br />
                    SubscriptionId: {{ $transaction->SubscriptionId}} <br />
                    IsLocalOrder: {{ $transaction->IsLocalOrder}} <br />
                    HideInvoiceId: {{ $transaction->HideInvoiceId}} <br />
                    Gateway: {{ $transaction->Gateway}} <br />
                    GatewayName: {{ $transaction->GatewayName}} <br />
                    ApplePay: {{ $transaction->ApplePay}} <br />
                    AndroidPay: {{ $transaction->AndroidPay}} <br />
                    TotalFee: {{ $transaction->TotalFee}} <br />
                    ReasonCode: {{ $transaction->ReasonCode}} <br />
                </div>
                @endforeach
                @endif
                @else
                Нет данных
                @endif
            </div>
        </div>
    </div>
</div>


@endsection
@section('js')

<script>
    $(document).ready(function() {
        $('#deleteCustomerFormButton').on('click', function(e) {
            if (confirm('Вы действительно хотите удалить?')) {
                $("#deleteCustomerForm").submit();
            }
        });
    });
</script>
@endsection