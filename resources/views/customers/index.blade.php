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
                <th scope="col">Имя</th>
                <th scope="col">Телефон</th>
                <th scope="col">Email</th>
                <th scope="col">Подписка</th>
                <th scope="col">Статус</th>
                <th scope="col">Настройки</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
            <tr>
                <th scope="row">{{ $customer->id }}</th>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->phone }}</td>
                <td>{{ $customer->email }}</td>
                <td>
                    {{ $customer->subscription->Status ?? 'Нет данных' }}
                </td>
                <td>{{ $customer->customerStatus->title }}</td>
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