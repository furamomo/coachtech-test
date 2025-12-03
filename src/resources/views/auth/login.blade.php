@extends('layouts.app')

@section('head-title', 'Login')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/login.css') }}" />
@endsection

@section('button')
    <a href="{{ route('register') }}" class="header__button-text">register</a>
@endsection

@section('title')
    Login
@endsection

@section('content')
    <div class="content-inner">
        <form action="{{ route('login') }}" method="POST" class="login-form">
            @csrf

            {{-- メールアドレス --}}
            <div class="login-form__group">
                <label for="email" class="login-form__title">
                    メールアドレス
                </label>

                <input type="text" id="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}" class="login-form__input {{ $errors->has('email') ? 'input-error' : '' }}">

                @if ($errors->has('email'))
                    <ul class="login-form__error-list">
                        @foreach ($errors->get('email') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>

            {{-- パスワード --}}
            <div class="login-form__group">
                <label for="password" class="login-form__title">
                    パスワード
                </label>

                <input type="password" id="password" name="password" placeholder="例: coachtech1106" class="login-form__input {{ $errors->has('password') ? 'input-error' : '' }}">

                @if ($errors->has('password'))
                    <ul class="login-form__error-list">
                        @foreach ($errors->get('password') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                @if ($errors->has('auth'))
                    <p class="login-form__error-list">{{ $errors->first('auth') }}</p>
                @endif
            </div>

            {{-- ボタン --}}
            <div class="login-form__button">
                <button type="submit" class="login-form__button-input">
                    ログイン
                </button>
            </div>
        </form>
    </div>
@endsection
