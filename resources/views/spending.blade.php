@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="banner text-center d-flex align-items-center justify-content-between p-3 mb-5">
                <h1 class="w-100">Траты</h1>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <p class="col-sm-10"><span>Жилье пользователя <br></span>@if(isset($spending->home_price))Цена: {{$spending->home_price}} <br><img
                    src="{{asset('img/'.$spending->home_image)}}" width="300px" alt="">@else Нету@endif</p>
            <a class="btn btn-primary col-sm-2 mb-3" style="height: fit-content" data-toggle="collapse" href="#collapseHome" role="button" aria-expanded="false" aria-controls="collapseExample">
                Все жилье
            </a>
            <div class="collapse mt-3 mb-5" id="collapseHome">
                <div class="card card-body">
                    <div class="row">
                        @foreach($homes as $hom)
                            <div class="col-md-4 mb-3">
                                <p>Цена: {{$hom->price}}<img src="{{asset('img/coin.png')}}" alt=""><br>
                                    Расходы: {{$hom->communal}}<img src="{{asset('img/coin.png')}}" alt=""></p>
                                <p><img width="300px" src="{{asset('img/'.$hom->image)}}" alt=""></p>
                                    @if(isset($spending->home_id) && $hom->id == $spending->home_id)
                                        <form method="post" action="{{route('spending_delete')}}">
                                            @csrf
                                            <input type="hidden" name="home_id" value="{{$hom->id}}">
                                            <input type="submit" class="btn btn-outline-warning" value="Продать">
                                        </form>
                                    @else
                                        <form method="post" action="{{route('spending_change')}}">
                                            @csrf
                                            <input type="hidden" name="home_id" value="{{$hom->id}}">
                                            <input type="submit" class="btn btn-outline-success" value="Купить">
                                        </form>
                                    @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <p class="col-sm-10"><span>Транспорт пользователя <br></span>@if(isset($spending->transport_price))Цена: {{$spending->transport_price}} <br><img
                    src="{{asset('img/'.$spending->transport_image)}}" width="300px" alt="">@else Нету@endif</p>
            <a class="btn btn-primary col-sm-2 mb-3" style="height: fit-content" data-toggle="collapse" href="#collapseCar" role="button" aria-expanded="false" aria-controls="collapseExample">
                Все тачки
            </a>
            <div class="collapse mt-3 mb-5" id="collapseCar">
                <div class="card card-body">
                    <div class="row">
                        @foreach($cars as $ca)
                            <div class="col-md-4 mb-3">
                                <p>Цена: {{$ca->price}}<img src="{{asset('img/coin.png')}}" alt=""><br>
                                    Расходы: {{$ca->communal}}<img src="{{asset('img/coin.png')}}" alt=""></p>
                                <p><img width="300px" src="{{asset('img/'.$ca->image)}}" alt=""></p>
                                @if(isset($spending->transport_id) && $ca->id == $spending->transport_id)
                                    <form method="post" action="{{route('spending_delete')}}">
                                        @csrf
                                        <input type="hidden" name="transport_id" value="{{$ca->id}}">
                                        <input type="submit" class="btn btn-outline-warning" value="Продать">
                                    </form>
                                @else
                                    <form method="post" action="{{route('spending_change')}}">
                                        @csrf
                                        <input type="hidden" name="transport_id" value="{{$ca->id}}">
                                        <input type="submit" class="btn btn-outline-success" value="Купить">
                                    </form>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <p class="col-sm-10">Питание: </p>
            <div class="col-sm-2 p-0 mb-3">
                <form class="d-flex" action="{{route('spending_food_change')}}" method="post">
                    <select class="form-control" style="width:140px" name="food">
                    @foreach($foods as $foo)
                        <option @if($spending->food_id == $foo->id) selected="selected" @endif value="{{$foo->id}}">{{$foo->title}} {{$foo->communal}}</option>
                    @endforeach
                    </select>
                    @csrf
                    <input class="ml-1 btn btn-outline-success" type="submit" value="OK">
                </form>
            </div>
            <p class="col-sm-10">Прислуга (1200)<img src="{{asset('img/coin.png')}}" alt=""> : </p>
            <div class="col-sm-2">
                @if($spending->servant == 1)
                    <form method="post" action="{{route('spending_servant_delete')}}">
                        @csrf
                        <input type="submit" class="btn btn-outline-danger" value="Уволить">
                    </form>
                @else
                    <form method="post" action="{{route('spending_servant')}}">
                        @csrf
                        <input type="submit" class="btn btn-outline-success" value="Нанять">
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
