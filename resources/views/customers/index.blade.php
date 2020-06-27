@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
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
                    <div class="input-group date">
                        <input type="text" class="form-control form-control-sm" name="start_date" aria-label="Дата старта" value="{{ $customer->start_date }}" readonly />
                        <div class="input-group-append">
                            <span class="input-group-text calendar-clickable">
                                <i class="fa fa-calendar"></i>
                            </span>
                        </div>
                    </div>
                </td>
                <td class="editable">
                    <div class="input-group date">
                        <input type="text" class="form-control form-control-sm" name="end_date" aria-label="Дата старта" value="{{ $customer->end_date }}" readonly>
                        <div class="input-group-append">
                            <span class="input-group-text calendar-clickable">
                                <i class="fa fa-calendar"></i>
                            </span>
                        </div>
                    </div>
                </td>
                <td>{{ $customer->daysLeft() }}</td>
                <td class="editable">
                    <input type="text" name="name" class="form-control form-control-sm" value="{{ $customer->name }}" readonly />
                </td>
                <td class="editable">
                    <input type="text" name="phone" class="form-control form-control-sm" value="{{ $customer->phone }}" readonly />
                </td>
                <td>
                    {{ $customer->subscription->Status ?? 'Нет данных' }}
                </td>
                <td class="editable">
                    <select name="remark_id" class="form-control form-control-sm" style="background-color: {{$customer->remark->color }};">
                        @foreach($remarks as $remark)
                        <option value="{{ $remark->id }}" data-background-color="{{ $remark->color }};" style="background-color: {{ $remark->color }};" @if($customer->remark->id == $remark->id)
                            selected
                            @endif
                            >
                            {{ $remark->title }}
                        </option>
                        @endforeach
                    </select>
                </td>
                <td class="editable">
                    <select name="subscription_type_id" class="form-control form-control-sm">
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
                <td class="text-right">
                    <button type="button" class="btn btn-danger btn-sm save-button" style="display: none;" title="Сохранить">
                        <i class="fa fa-save"></i>
                    </button>
                    <div class="btn-group" role="group">
                        <button class="btn btn-outline-dark btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.ru.min.js"></script> -->
<script>
    var update = function(id, model) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var data = {
            _method: "PUT",
            ...model
        };

        return $.ajax({
            url: `/customers/${id}`,
            method: "POST",
            data: data,
            dataType: "html"
        });
    }

    $(document).ready(function() {
        $("#filter .card-body").hide();
        $("#filter-toggle").on("click", function() {
            $("#filter .card-body").toggle("slide");
            $("#filter-toggle > i.fa").toggleClass("fa-toggle-on");
        });

        $(".date").datepicker({
            format: 'd MM yyyy',
            autoclose: true
        });

        $(".editable").on("click", "input", function() {
            $(this).prop("readonly", false);
        });
        $(".editable").on("change", "input, select", function() {
            var tr = $(this).closest("tr");
            tr.addClass("touched");
            if ($(this).attr('name') == "remark_id") {
                $(this).attr("style", `background-color: ${$(this).find("option:selected").attr('data-background-color')}`);
            }
            if (tr.hasClass("touched")) {
                tr.find(".save-button").show();
            }
        });

        $(".save-button").on("click", function() {
            if (confirm("Действительно сохранить изменения?")) {
                var tr = $(this).closest("tr");
                var $this = $(this);

                update(tr.attr("data-id"), {
                        start_date: tr.find("input[name='start_date']").val(),
                        end_date: tr.find("input[name='end_date']").val(),
                        name: tr.find("input[name='name']").val(),
                        phone: tr.find("input[name='phone']").val(),
                        remark_id: tr.find("select[name='remark_id']").val(),
                        subscription_type_id: tr.find("select[name='subscription_type_id']").val(),
                    })
                    .done(function(response) {
                        tr.find("input").each(function(i, el) {
                            $(el).prop("readonly", true);
                        });
                        tr.removeClass("touched");
                        $this.hide();
                    })
                    .fail(function(error) {
                        alert("Ошибка:\n" + error.statusText);
                    });

            }
        });
    });
</script>
@endsection