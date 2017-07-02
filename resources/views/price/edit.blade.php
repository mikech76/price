@extends('layouts.app')

@section('content')
    <div class="container">
        <form class="form-horizontal" method="POST" action="{{$action}}">
            <label class="control-label">{{isset($price->id)? 'Прайс № : '.$price->id : 'Новый прайс'}}</label>
            <input type="text" class="form-control" name="name" value="{{$price->name}}">
            <input class="btn btn-primary" type="submit" value="{{isset($price->id) ? 'Изменить' : 'Добавить'}}">
            <input type="hidden" name="_method" value="{{$method}}">
            {{csrf_field()}}
        </form>
</div>
@endsection