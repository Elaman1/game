@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="banner text-center d-flex align-items-center justify-content-between p-3 mb-5">
                <h1 class="w-100">Личный кабинет</h1>
            </div>
        </div>
    </div>
    <div class="container">
        Надо сделать
        <ul>
            <li>Профиль (сколько лет что минусуем по здоровью и по счастьем</li>
            <li>aa</li>
        </ul>
        <a class="d-block" href="{{ route('spending') }}">Траты</a>
        <a class="d-block" href="{{ route('career') }}">Работа</a>
    </div>
@endsection
