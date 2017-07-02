@extends('layouts.app')

@section('content')
<div class="container">
    <div class="panel-heading">Прайс: {{$price->name}}</div>

    <form class="form-horizontal" method="POST" action="{{$action}}">
        <label class="control-label">{{isset($product->id)? 'Продукт № : '.$product->id : 'Новый продукт'}}</label>
        <input type="text" class="form-control" name="name" value="{{$product->name}}">

        <label class="control-label">Единицы измерения</label>
        <input type="text" class="form-control" name="units" value="{{$product->units}}">

        <label class="control-label">Цена</label>
        <input type="text" class="form-control" name="price" value="{{$product->price}}">

        <label class="control-label">Количество на складе</label>
        <input type="text" class="form-control" name="quantity" value="{{$product->quantity}}">


        <input class="btn btn-primary" type="submit" value="{{isset($product->id) ? 'Изменить' : 'Добавить'}}">
        <input type="hidden" name="_method" value="{{$method}}">
    {{csrf_field()}}
    </form>
</div>
@endsection