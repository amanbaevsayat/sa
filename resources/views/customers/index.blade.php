@extends('layouts.app')

@section('css')
<style>
    th,
    td {
        text-align: center;
    }
</style>
@endsection

@section('content')

<div class="row">
    <div class="col-11">
        <div class="card mb-2" id="filter">
            <div class="card-header py-1">
                Фильтр
                <small class="float-right">
                    <button id="filter-toggle" class="btn btn-default btn-sm" title="Скрыть/показать">
                        <i class="fa fa-toggle-off"></i>
                    </button>
                </small>
            </div>
            <div class="card-body">
                <form action="/customers" method="GET">
                    @csrf
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="subscriptionStatus">Статус подписки</label>
                                <select class="form-control" id="subscriptionStatus" name="subscriptionStatus[]" multiple>
                                    @foreach($subscriptionStatuses as $subscriptionStatus)
                                    <option value="{{$subscriptionStatus}}" @if (!is_null(request("subscriptionStatus")) && in_array($subscriptionStatus, request("subscriptionStatus"))) selected @endif>{{$subscriptionStatus}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="remark_id">Ремарка</label>
                                <select class="form-control" id="remark_id" name="remark_id[]" multiple>
                                    @foreach($remarks as $remark)
                                    <option value="{{$remark->id}}" @if (!is_null(request("remark_id")) && request("remark_id") && in_array($remark->id, request("remark_id")))
                                        selected
                                        @endif
                                        >
                                        {{$remark->title}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="subscription_type_id">Тип</label>
                                <select class="form-control" id="subscription_type_id" name="subscription_type_id[]" multiple>
                                    @foreach($subscriptionTypes as $subscriptionType)
                                    <option value="{{$subscriptionType->id}}" @if (!is_null(request("subscription_type_id")) && in_array($subscriptionType->id, request("subscription_type_id")))
                                        selected
                                        @endif
                                        >{{$subscriptionType->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div>
                        <input type="submit" class="btn btn-success btn-sm" value="Найти" />
                        <a href="/customers" class="btn btn-dark btn-sm">Очистить</a>
                        <small class="float-right">
                            Зажмите CTRL, чтобы выбрать несколько параметров
                        </small>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-1">
        <a href="/customers/create" class="btn btn-info btn-block text-white mb-2" title="Добавить">
            <i class="fa fa-plus"></i>
        </a>
    </div>
</div>
<div class="table-responsive bg-white">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Дата старта</th>
                <th scope="col">Дата окончания</th>
                <th scope="col">Осталось дней</th>
                <th scope="col">Имя</th>
                <th scope="col">Телефон</th>
                <th scope="col">Статус подписки</th>
                <th scope="col">Ремарка</th>
                <th scope="col">Тип</th>
                <th scope="col">Настройки</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $key => $customer)
            <tr>
                <th scope="row">{{ ($customers->currentpage()-1) * $customers->perpage() + $key + 1  }}</th>
                <td>{{ $customer->start_date }}</td>
                <td>{{ $customer->end_date }}</td>
                <td>{{ $customer->daysLeft() }}</td>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->phone }}</td>
                <td>
                    {{ $customer->subscription->Status ?? 'Нет данных' }}
                </td>
                <td style="background-color: {{$customer->remark->color }};">{{ $customer->remark->title }}</td>
                <td>{{ $customer->subscriptionType->title }}</td>
                <td>
                    <a href="/customers/{{ $customer->id }}/edit" class="btn btn-sm btn-default mx-2" title="Редактировать">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <a href="/customers/{{ $customer->id }}" class="btn btn-sm btn-default mx-2" title="Подробнее">
                        <i class="fa fa-list"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{ $customers->withQueryString()->links() }}
@endsection

@section('js')
<script>
    $("#filter .card-body").hide();
    $("#filter-toggle").on("click", function() {
        $("#filter .card-body").toggle("slide");
        $("#filter-toggle > i.fa").toggleClass("fa-toggle-on");
    })
</script>
@endsection