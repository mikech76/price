@extends('layouts.app')

@section('content')
    <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Прайсы</div>
                <table class="table table-striped">
                    <tr>
                        <th>id</th>
                        <th>Наименование</th>
                        <th></th>
                    </tr>

                    @foreach($prices as $price)
                    <tr>
                        <td>{{$price->id}}</td>
                        <td> <a href="price/{{$price->id}}">{{$price->name}}</a></td>
                        <td>
                            <a href="price/{{$price->id}}/edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <a href="price/{{$price->id}}/delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>

                    </tr>
                    @endforeach
                </table>
                <div class="panel-footer">
                    <a href="price/create" class="label label-primary">
                        <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                        Новый прайс
                    </a>
                    <div class="navbar-right">Всего: <span class="badge">{{$count}}</span></div>
                </div>

                <div class="text-center">{!! $prices->render() !!} </div>

            </div>
        </div>
    </div>
</div>
@endsection
