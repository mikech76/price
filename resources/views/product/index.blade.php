
                <table class="table table-striped">
                    <tr>
                        <th>id</th>
                        <th>Наименование продукции</th>
                        <th>Ед.изм.</th>
                        <th>Цена</th>
                        <th>Кол-во на складе</th>
                        <th></th>
                    </tr>

                    @foreach($products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td> {{$product->name}}</td>
                        <td> {{$product->units}}</td>
                        <td> {{$product->price}}</td>
                        <td> {{$product->quantity}}</td>
                        <td>
                            <a href="{{$price->id}}/product/{{$product->id}}/edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <a href="{{$price->id}}/product/{{$product->id}}/delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>

                    </tr>
                    @endforeach
                </table>

                <div class="panel-footer">
                    <a href="{{$price->id}}/product/create" class="label label-primary">
                        <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                        Новый продукт
                    </a>
                    <div class="navbar-right">Всего: <span class="badge">{{$product_count}}</span></div>
                </div>

                <div class="text-center">{!! $products->render() !!} </div>
