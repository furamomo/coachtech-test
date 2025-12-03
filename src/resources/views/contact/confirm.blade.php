@extends('layouts.app')

@section('head-title', 'Contact')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contact/confirm.css') }}" />
@endsection

@section('title', 'Confirm')

@section('content')
    <div class="content-inner">

        <table class="confirm-table">

            {{-- お名前 --}}
            <tr class="confirm-table__row">
                <th class="confirm-table__header">
                    お名前
                </th>

                <td class="confirm-table__data">
                    {{ $contact['last_name'] }} {{ $contact['first_name'] }}
                </td>
            </tr>

            {{-- 性別 --}}
            <tr class="confirm-table__row">
                <th class="confirm-table__header">
                    性別
                </th>

                <td class="confirm-table__data">
                    @if($contact['gender'] == 1)
                        男性
                    @elseif($contact['gender'] == 2)
                        女性
                    @else
                        その他
                    @endif
                </td>
            </tr>

            {{-- メールアドレス --}}
            <tr class="confirm-table__row">
                <th class="confirm-table__header">
                    メールアドレス
                </th>

                <td class="confirm-table__data">
                    {{ $contact['email'] }}
                </td>
            </tr>

            {{-- 電話番号 --}}
            <tr class="confirm-table__row">
                <th class="confirm-table__header">
                    電話番号
                </th>

                <td class="confirm-table__data">
                    {{ $contact['tel1'] }}{{ $contact['tel2'] }}{{ $contact['tel3'] }}
                </td>
            </tr>

            {{-- 住所 --}}
            <tr class="confirm-table__row">
                <th class="confirm-table__header">
                    住所
                </th>

                <td class="confirm-table__data">
                    {{ $contact['address'] }}
                </td>
            </tr>

            {{-- 建物名 --}}
            <tr class="confirm-table__row">
                <th class="confirm-table__header">
                    建物名
                </th>

                <td class="confirm-table__data">
                    {{ $contact['building'] }}
                </td>
            </tr>

            {{-- お問い合わせの種類 --}}
            <tr class="confirm-table__row">
                <th class="confirm-table__header">
                    お問い合わせの種類
                </th>

                <td class="confirm-table__data">
                    {{ $category_content }}
                </td>
            </tr>

            {{-- お問い合わせ内容 --}}
            <tr class="confirm-table__row">
                <th class="confirm-table__header">
                    お問い合わせ内容
                </th>

                <td class="confirm-table__data">
                    {{ $contact['detail'] }}
                </td>
            </tr>

        </table>

        {{-- ボタンエリア --}}
        <div class="confirm-actions">

            {{-- 送信 --}}
            <form action="{{ route('contact.store') }}" method="POST" class="confirm-actions__form">
                @csrf

                @foreach($contact as $key => $value)
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endforeach

                <button type="submit" class="confirm-actions__button confirm-actions__button--primary">
                    送信
                </button>
            </form>

            {{-- 修正 --}}
            <form action="{{ route('contact.back') }}" method="POST" class="confirm-actions__form">
                @csrf

                @foreach($contact as $key => $value)
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endforeach

                <button type="submit" class="confirm-actions__button confirm-actions__button--back">
                    修正
                </button>
            </form>
        </div>

    </div>
@endsection
