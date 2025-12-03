@extends('layouts.app')

@section('head-title', 'Register')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/register.css') }}" />
@endsection

@section('button')
    <a href="{{route('login')}}" class="header__button-text">login</a>
@endsection

@section('title')
    Register
@endsection

@section('content')
    <div class="content-inner">
        <form action="{{ route('register') }}" method="POST" class="register-form">
            @csrf

            {{-- お名前 --}}
            <div class="register-form__group">
                <label for="name" class="register-form__title">
                    お名前
                </label>

                <input type="text" id="name" name="name" placeholder="例: 山田 太郎" value="{{ old('name') }}" class="register-form__input {{ $errors->has('password') ? 'input-error' : '' }}">

                @if ($errors->has('name'))
                    <ul class="register-form__error-list">
                        @foreach ($errors->get('name') as $error)
                            <li class="register-form__error">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>

            {{-- メールアドレス --}}
            <div class="register-form__group">
                <label for="email" class="register-form__title">
                    メールアドレス
                </label>

                <input type="text" id="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}" class="register-form__input {{ $errors->has('password') ? 'input-error' : '' }}">

                @if ($errors->has('email'))
                    <ul class="register-form__error-list">
                        @foreach ($errors->get('email') as $error)
                            <li class="register-form__error">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>

            {{-- パスワード --}}
            <div class="register-form__group">
                <label for="password" class="register-form__title">
                    パスワード
                </label>

                <input type="password" id="password" name="password" placeholder="例: coachtech1106" class="register-form__input {{ $errors->has('password') ? 'input-error' : '' }}">

                @if ($errors->has('password'))
                    <ul class="register-form__error-list">
                        @foreach ($errors->get('password') as $error)
                            <li class="register-form__error">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>

            {{-- ボタン --}}
            <div class="register-form__button">
                <button type="submit" class="register-form__button-input">
                    登録
                </button>
            </div>

        </form>
    </div>
@endsection
