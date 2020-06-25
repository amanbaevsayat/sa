@extends('layouts.app')

@section('content')
<a href="/customers/create" class="btn btn-info text-white float-right mb-2">
    Новый
</a>
<div class="table-responsive">
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
{{ $customers->links() }}
@endsection