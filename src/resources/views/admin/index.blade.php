@extends('layouts.app')

@section('head-title', 'Admin')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/search.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/table.css') }}">
@endsection

@section('button')
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="header__button-text">logout</button>
    </form>
@endsection

@section('title')
    Admin
@endsection

@section('content')

<div class="content-inner">

    {{--  検索フォーム --}}
    <form action="{{ route('admin.search') }}" method="GET" class="admin-search">

        {{-- 名前・メールアドレス --}}
        <input type="text" name="keyword" placeholder="お名前やメールアドレスを入力してください" value="{{ request('keyword') }}" class="admin-search__input admin-search__input--wide"/>

        {{-- 性別 --}}
        <div class="admin-search__wrapper admin-search__wrapper--gender">
            <select name="gender" class="admin-search__select ">
                <option value="" selected>性別</option>
                <option value="all">全て</option>
                <option value="1" {{ request('gender') == 1 ? 'selected' : '' }}>男性</option>
                <option value="2" {{ request('gender') == 2 ? 'selected' : '' }}>女性</option>
                <option value="3" {{ request('gender') == 3 ? 'selected' : '' }}>その他</option>
            </select>
        </div>

        {{-- お問い合わせの種類 --}}
        <div class="admin-search__wrapper admin-search__wrapper--category">
            <select name="category_id" class="admin-search__select">
                <option value="">お問い合わせの種類</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->content }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- 日付 --}}
        <input type="date" name="date" value="{{ request('date') }}" class="admin-search__input admin-search__date"/>

        {{-- 検索ボタン --}}
        <button type="submit" class="admin-search__search-button">
            検索
        </button>

        {{-- リセット --}}
        <a href="{{ route('admin.reset') }}" class="admin-search__reset">
            リセット
        </a>

    </form>

    {{-- エクスポートボタン + ページネーション --}}
    <div class="admin-actions">

        <a href="{{ route('admin.export', request()->query()) }}" class="admin-actions__export-link">
            エクスポート
        </a>

        <div class="admin-actions__pagination">
            {{ $contacts->links() }}
        </div>
    </div>

    {{-- お問い合わせ一覧テーブル --}}
    <table class="admin-table">

        <thead class="admin-table__head">
            <tr class="admin-table__row">
                <th class="admin-table__header">お名前</th>
                <th class="admin-table__header">性別</th>
                <th class="admin-table__header">メールアドレス</th>
                <th class="admin-table__header">お問い合わせの種類</th>
                <th class="admin-table__header"></th>
            </tr>
        </thead>

        <tbody class="admin-table__body">
            @foreach($contacts as $contact)
                <tr class="admin-table__row">

                    <td class="admin-table__data">{{ $contact->full_name }}</td>

                    <td class="admin-table__data">{{ $contact->gender_label }}</td>

                    <td class="admin-table__data">{{ $contact->email }}</td>

                    <td class="admin-table__data">{{ $contact->category->content }}</td>

                    <td class="admin-table__data">
                        <a href="#modal-{{ $contact->id }}" class="admin-table__detail-button">
                            詳細
                        </a>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- モーダル --}}
    @foreach($contacts as $contact)
        <div id="modal-{{ $contact->id }}" class="admin-modal">

            <div class="admin-modal__content">
                <div class="admin-modal__content-inner">

                    <div class="admin-modal__close">
                        <a href="#" class="admin-modal__close-text">×</a>
                    </div>

                    <table class="admin-modal__table">
                        <tr>
                            <th class="admin-modal__header">お名前</th>
                            <td class="admin-modal__data">{{ $contact->full_name }}</td>
                        </tr>

                        <tr>
                            <th class="admin-modal__header">性別</th>
                            <td class="admin-modal__data">{{ $contact->gender_label }}</td>
                        </tr>

                        <tr>
                            <th class="admin-modal__header">メールアドレス</th>
                            <td class="admin-modal__data">{{ $contact->email }}</td>
                        </tr>

                        <tr>
                            <th class="admin-modal__header">電話番号</th>
                            <td class="admin-modal__data">{{ $contact->tel }}</td>
                        </tr>

                        <tr>
                            <th class="admin-modal__header">住所</th>
                            <td class="admin-modal__data">{{ $contact->address }}</td>
                        </tr>

                        <tr>
                            <th class="admin-modal__header">建物名</th>
                            <td class="admin-modal__data">{{ $contact->building }}</td>
                        </tr>

                        <tr>
                            <th class="admin-modal__header">お問い合わせの種類</th>
                            <td class="admin-modal__data">{{ $contact->category->content }}</td>
                        </tr>

                        <tr>
                            <th class="admin-modal__header">お問い合わせ内容</th>
                            <td class="admin-modal__data">{{ $contact->detail }}</td>
                        </tr>
                    </table>
                </div>

                <form action="{{ route('admin.delete', $contact->id) }}" method="POST" class="admin-modal__delete-form">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="admin-modal__delete-button">
                        削除
                    </button>
                </form>

            </div>

        </div>
    @endforeach

</div>
@endsection
