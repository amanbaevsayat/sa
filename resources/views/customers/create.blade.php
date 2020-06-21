@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="/customers" method="POST">
            @csrf
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Имя</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" value="" name="name">
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" value="" name="email">
                </div>
            </div>
            <div class="form-group row">
                <label for="phone" class="col-sm-2 col-form-label">Телефон</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="phone" value="" name="phone">
                </div>
            </div>
            <div class="form-group row">
                <label for="customer_status_id" class="col-sm-2 col-form-label">Статус</label>
                <div class="col-sm-10">
                    <select name="customer_status_id" id="customer_status_id" class="form-control" name="customer_status_id">
                        @foreach($customerStatuses as $customerStatus)
                        <option value="{{$customerStatus->id}}">
                            {{$customerStatus->title}}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="subscriptionId" class="col-sm-2 col-form-label">SUbId</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="subscriptionId" value="" name="subscriptionId">
                </div>
            </div>

            <div class="form-group">
                <input type="submit" value="Добавить" class="btn btn-success" />
            </div>
        </form>
        <a href="/customers">К списку</a>
    </div>
</div>
@endsection