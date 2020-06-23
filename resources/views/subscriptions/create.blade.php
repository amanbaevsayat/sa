@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="/subscriptions" method="POST">
            @csrf
            <div class="form-group row">
                <label for="OriginId" class="col-sm-2 col-form-label">OriginId</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="OriginId" value="" name="OriginId">
                </div>
            </div>

            <div class="form-group">
                <input type="submit" value="Добавить" class="btn btn-success" />
            </div>
        </form>
        <a href="/subscriptions">К списку</a>
    </div>
</div>
@endsection