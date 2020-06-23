@extends('layouts.app')

@section('content')
<a href="/subscriptions/create" class="btn btn-info text-white float-right mb-2">
    Новый
</a>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">OriginId</th>
                <th scope="col">Аккаунт</th>
                <th scope="col">Email</th>
                <th scope="col">Статус</th>
                <th scope="col">Подробнее</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subscriptions->sortByDesc('Status') as $subscription)
            <tr>
                <th scope="row">{{ $subscription->id }}</th>
                <td>{{ $subscription->OriginId }}</td>
                <td>{{ $subscription->AccountId }}</td>
                <td>{{ $subscription->Email }}</td>
                <td>{{ $subscription->Status }}</td>
                <td>
                    <a href="/subscriptions/{{ $subscription->id }}" class="btn btn-sm btn-default mx-2" title="Подробнее">
                        <i class="fa fa-list"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{ $subscriptions->links() }}
@endsection