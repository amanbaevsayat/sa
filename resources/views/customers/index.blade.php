@extends('layouts.app')

@section('content')
<a href="/customers/create" class="btn btn-info">Новый</a>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Имя</th>
                <th scope="col">Телефон</th>
                <th scope="col">Email</th>
                <th scope="col">Подписки</th>
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
                    {{ $customer->subscription->Status ?? '' }}
                </td>
                <td>{{ $customer->customerStatus->title }}</td>
                <td>
                    <a href="/customers/{{ $customer->id }}/edit">
                        Редактировать
                    </a>
                    <a href="/customers/{{ $customer->id }}">
                        Подробнее
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{ $customers->links() }}
@endsection