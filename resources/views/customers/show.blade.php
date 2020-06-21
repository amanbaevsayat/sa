@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <p class="card-text">Имя: {{$customer->name}}</p>
        <p class="card-text">Телефон: {{$customer->phone}}</p>
        <p class="card-text">Email: {{$customer->email}}</p>
        <p class="card-text">Sub: {{$customer->subscriptionId}}</p>
        <p class="card-text">Статус: {{$customer->customerStatus->title}}</p>
        <form action="/customers/{{$customer->id}}" method="POST">
            @csrf
            @method('DELETE')
            <input type="submit" value="Удалить" class="btn btn-danger" />
        </form>
        <a href="/customers">К списку</a>
    </div>
</div>
@endsection