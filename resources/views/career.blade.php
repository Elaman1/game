@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="banner text-center d-flex align-items-center justify-content-between p-3 mb-5">
                <h1 class="w-100">Карьера и фриланс</h1>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <p class="col-sm-10">Должность: </p>
            <p class="col-sm-2">@if(isset($work->post) && $pivotUserWork->active != 0) {{$work->post}} @else Нету @endif</p>

            <p class="col-sm-10">Зарплата: </p>
            <p class="col-sm-2">@if(isset($work->salary) && $pivotUserWork->active != 0) {{$work->salary}}<img class="ml-2" title="Зарплата" src="{{asset('img/coin.png')}}"> @else Нету @endif</p>

            <p class="col-sm-10">Затраты времени на работу: </p>
            <p class="col-sm-2">@if(isset($work->post) && $pivotUserWork->active != 0) 40<img class="ml-2" title="Энергия" src="{{asset('img/lightning.png')}}"> @else Нету @endif</p>

            @if ($pivotUserWork->active == 0)
            <form class="mr-3" action="{{route('search_work')}}" method="post">
                @csrf
                <input class="btn btn-outline-success" type="submit" value="Искать работу (30 энергии)">
            </form>
            @else
                <form class="mr-3" action="{{route('more_work')}}" method="post">
                    @csrf
                    <input class="btn btn-outline-success" type="submit" value="Упорно работать (25 энергии)">
                </form>
                <form class="mr-3" action="{{route('up_post')}}" method="post">
                    @csrf
                    <input class="btn btn-outline-primary" type="submit" value="Просить повышение: {{$pivotUserWork->chance_up}}% шанс">
                </form>
                <form class="mr-3" action="{{route('get_out_work')}}" method="post">
                    @csrf
                    <input class="btn btn-outline-danger" type="submit" value="Выйти с работы">
                </form>
            @endif
        </div>
    </div>
@endsection
