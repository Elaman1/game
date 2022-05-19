@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="banner d-flex flex-column align-items-center text-center justify-content-sm-center min-vh-100">
                <h2>GameN1 - сыграй в свое удовольствие</h2>
                <p>Проживи жизнь и посмотри кем ты станешь <br>
                    и поборись за первое место в топе</p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="col-md-12">
            <div class="content-body">
                <p class="text-center mb-5">Познай себя<br>
                    присоединяйся к 345 игрокам уже сегодня!</p>
                <div class="info-main mb-5">

                    <h4>GameN1&?</h4>
                    <p>Игра, становящаяся все лучше и лучше с каждым днем! Игра, от которой не так то просто оторваться! Хочешь почувствовать себя настоящим гонщиком? Тогда регистрируйся, приглашай друзей, покупай и прокачивай тачки, выигрывай турниры и стань чемпионом!</p>

                </div>
            </div>
        </div>
    </div>
@endsection
