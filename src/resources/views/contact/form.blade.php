@extends('layouts.app')

@section('head-title', 'Contact')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contact/form.css') }}" />
@endsection

@section('title', 'Contact')

@section('content')

<div class="content-inner">
    <form action="{{ route('contact.confirm') }}" method="POST" class="contact-form">
        @csrf

        {{-- お名前 --}}
        <div class="contact-form__group contact-form__group--name">
            <label class="contact-form__title">お名前 <span class="required">※</span></label>

            <div class="contact-form__row content-form__row--name">
                <div class="contact-form__input-wrapper">
                    {{-- 姓 --}}
                    <input type="text" name="last_name" placeholder="例: 山田" value="{{ old('last_name') }}" class="contact-form__input  contact-form__input-name {{ $errors->has('last_name') ? 'input-error' : '' }}">

                    {{-- 名 --}}
                    <input type="text" name="first_name" placeholder="例: 太郎" value="{{ old('first_name') }}" class="contact-form__input contact-form__input-name {{ $errors->has('first_name') ? 'input-error' : '' }}">
                </div>

                <div class="contact-form__error-row">
                    <div class="contact-form__error">
                        @if ($errors->has('last_name'))
                            <ul class="contact-form__error-list">
                                @foreach ($errors->get('last_name') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                    <div class="contact-form__error">
                        @if ($errors->has('first_name'))
                            <ul class="contact-form__error-list">
                                @foreach ($errors->get('first_name') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>

        </div>

        {{-- 性別 --}}
        <div class="contact-form__group">
            <label class="contact-form__title">性別 <span class="required">※</span></label>

            <div class="contact-form__field {{ $errors->has('gender') ? 'error-field' : '' }}">
                <div class="contact-form__row contact-form__row--gender">
                    <label><input type="radio" name="gender" value="1" {{ old('gender')=='1' ? 'checked' : '' }}> 男性</label>
                    <label><input type="radio" name="gender" value="2" {{ old('gender')=='2' ? 'checked' : '' }}> 女性</label>                        <label><input type="radio" name="gender" value="3" {{ old('gender')=='3' ? 'checked' : '' }}> その他</label>
                </div>

                @if ($errors->has('gender'))
                    <ul class="contact-form__error-list">
                        @foreach ($errors->get('gender') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

        {{-- メールアドレス --}}
        <div class="contact-form__group">
            <label class="contact-form__title">メールアドレス <span class="required">※</span></label>

            <div class="contact-form__field">
                <input type="text" name="email" placeholder="例: test@example.com"
                    value="{{ old('email') }}"
                    class="contact-form__input {{ $errors->has('email') ? 'input-error' : '' }}">

                @if ($errors->has('email'))
                    <ul class="contact-form__error-list">
                        @foreach ($errors->get('email') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

        {{-- 電話番号 --}}
        <div class="contact-form__group">
            <label class="contact-form__title">電話番号 <span class="required">※</span></label>

            <div class="contact-form__field">
                <div class="contact-form__row">

                    <input type="text" name="tel1" placeholder="080" value="{{ old('tel1') }}"
                        class="contact-form__input {{ $errors->has('tel1') ? 'input-error' : '' }}">

                    <span class="contact-form__hyphen">-</span>

                    <input type="text" name="tel2" placeholder="1234" value="{{ old('tel2') }}"
                        class="contact-form__input {{ $errors->has('tel2') ? 'input-error' : '' }}">

                    <span class="contact-form__hyphen">-</span>

                    <input type="text" name="tel3" placeholder="5678" value="{{ old('tel3') }}"
                        class="contact-form__input {{ $errors->has('tel3') ? 'input-error' : '' }}">
                </div>

                @if ($errors->has('tel'))
                    <ul class="contact-form__error-list">
                        @foreach ($errors->get('tel') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

        {{-- 住所 --}}
        <div class="contact-form__group">
            <label class="contact-form__title">住所 <span class="required">※</span></label>

            <div class="contact-form__field">
                <input type="text" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3"
                    value="{{ old('address') }}"
                    class="contact-form__input {{ $errors->has('address') ? 'input-error' : '' }}">

                @if ($errors->has('address'))
                    <ul class="contact-form__error-list">
                        @foreach ($errors->get('address') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

        {{-- 建物名 --}}
        <div class="contact-form__group">
            <label class="contact-form__title">建物名</label>

            <div class="contact-form__field">
                <input type="text" name="building" placeholder="例: 千駄ヶ谷マンション101"
                    value="{{ old('building') }}"
                    class="contact-form__input {{ $errors->has('building') ? 'input-error' : '' }}">

                @if ($errors->has('building'))
                    <ul class="contact-form__error-list">
                        @foreach ($errors->get('building') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

        {{-- お問い合わせの種類 --}}
        <div class="contact-form__group">
            <label class="contact-form__title">お問い合わせの種類 <span class="required">※</span></label>

            <div class="contact-form__field">
                <div class="contact-form__wrapper">
                    <select name="category_id"
                        class="contact-form__select {{ $errors->has('category_id') ? 'input-error' : '' }}">
                        <option value="" selected hidden>選択してください</option>

                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->content }}
                            </option>
                        @endforeach
                    </select>
                </div>

                @if ($errors->has('category_id'))
                    <ul class="contact-form__error-list">
                        @foreach ($errors->get('category_id') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>


        {{-- お問い合わせ内容 --}}
        <div class="contact-form__group">
            <label class="contact-form__title">お問い合わせ内容 <span class="required">※</span></label>

            <div class="contact-form__field">
                <textarea name="detail" rows="5"
                    placeholder="お問い合わせ内容をご記載ください"
                    class="contact-form__textarea {{ $errors->has('detail') ? 'input-error' : '' }}">{{ old('detail') }}</textarea>

                @if ($errors->has('detail'))
                    <ul class="contact-form__error-list">
                        @foreach ($errors->get('detail') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

        {{-- 確認ボタン --}}
        <div class="contact-form__submit">
            <button type="submit" class="contact-form__button">確認画面</button>
        </div>

    </form>
</div>

@endsection
