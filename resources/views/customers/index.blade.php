@extends('layouts.app')

@section('css')
<style>
    th,
    td {
        text-align: center;
    }

    td.editable input[type='text'],
    td.editable select {
        width: 100px;
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
    <table class="table table-striped table-sm">
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
                <th scope="col">
                    <i class="fa fa-cog"></i>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $key => $customer)
            <tr data-id="{{ $customer->id }}">
                <th scope="row">{{ ($customers->currentpage()-1) * $customers->perpage() + $key + 1  }}</th>
                <td class="editable">
                    <div class="input-group">
                        <input type="text" class="form-control form-control-sm" name="start_date" aria-label="Дата старта" value="{{ $customer->start_date }}" disabled>
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="fa fa-calendar"></i>
                            </span>
                        </div>
                    </div>
                </td>
                <td class="editable">
                    <div class="input-group">
                        <input type="text" class="form-control form-control-sm" name="end_date" aria-label="Дата старта" value="{{ $customer->end_date }}" disabled>
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="fa fa-calendar"></i>
                            </span>
                        </div>
                    </div>
                </td>
                <td>{{ $customer->daysLeft() }}</td>
                <td class="editable">
                    <input type="text" name="name" class="form-control form-control-sm" value="{{ $customer->name }}" disabled />
                </td>
                <td class="editable">
                    <input type="text" name="phone" class="form-control form-control-sm" value="{{ $customer->phone }}" disabled />
                </td>
                <td>
                    {{ $customer->subscription->Status ?? 'Нет данных' }}
                </td>
                <td class="editable" style="background-color: {{$customer->remark->color }};">
                    <select name="remark_id" class="form-control form-control-sm" disabled>
                        @foreach($remarks as $remark)
                        <option value="{{ $remark->id }}" @if($customer->remark->id == $remark->id)
                            selected
                            @endif
                            >
                            {{ $remark->title }}
                        </option>
                        @endforeach
                    </select>
                </td>
                <td class="editable">
                    <select name="subscription_type_id" class="form-control form-control-sm" disabled>
                        @foreach($subscriptionTypes as $subscriptionType)
                        <option value="{{ $subscriptionType->id }}" @if($customer->subscriptionType->id == $subscriptionType->id)
                            selected
                            @endif
                            >
                            {{ $subscriptionType->title }}
                        </option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-cog"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a href="/customers/{{ $customer->id }}/edit" class="dropdown-item" title="Редактировать">
                            Редактировать
                        </a>
                        <a href="/customers/{{ $customer->id }}" class="dropdown-item" title="Подробнее">
                            Подробнее
                        </a>
                    </div>
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
    var updateProperty = function(id, name, value) {
        var data = {
            _token: $("meta[name='csrf-token']").attr('content'),
        };
        data[name] = value;
        $.ajax({
                url: `/customers/${id}`,
                method: "POST",
                data: data
            })
            .done(function(response) {
                console.log(response);
            })
            .fail(function(error) {
                console.log(error);
            })
            .always(function(response) {
                console.log(response);
            });

    }
    $(document).ready(function() {
        $("#filter .card-body").hide();
        $("#filter-toggle").on("click", function() {
            $("#filter .card-body").toggle("slide");
            $("#filter-toggle > i.fa").toggleClass("fa-toggle-on");
        });

        $(".editable").on("click", function() {
            var id = $(this).closest("tr").attr("data-id");
            var name = $(this).attr("data-name");
            var value = $(this).text();
        });
    });
</script>
@endsection