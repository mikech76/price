@extends('layouts.app')

@section('content')
    <div class="container">
     <form class="form-horizontal" method="POST" action="{{$action}}">
        <label class="control-label">Прайс №{{$price->id}}</label>
        <input type="text" class="form-control" name="name" value="{{$price->name}}">
        <input class="btn btn-primary" type="submit" value="Изменить">
        <input type="hidden" name="_method" value="{{$method}}">
         {{csrf_field()}}
    </form>
</div>
@endsection