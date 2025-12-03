@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contact/thanks.css') }}" />
@endsection

@section('header-class', 'header--hidden')

@section('content')

    <div class="thanks-page">

        <div class="thanks-page__content">
            <p class="thanks-page__text">お問い合わせありがとうございました</p>

            <div class="thanks-page__button">
                <a href="{{ route('contact.index') }}" class="thanks-page__button-text">
                    HOME
                </a>
            </div>
        </div>

    </div>

@endsection