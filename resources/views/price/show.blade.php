@extends('layouts.app')

@section('content')
    <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                <form action="">
                    <div class="panel-heading">Прайс: {{$price->name}}
                        <div class="navbar-right">
                            Поиск: <input type="text" name="search" value="{{$search}}">
                        </div>
                    </div>
                </form>
                @include('product.index')

            </div>
        </div>
    </div>
</div>
@endsection
