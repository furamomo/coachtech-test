<!DOCTYPE html>
<html lang="ja">

<head>

    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>@yield('head-title')</title>

    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/layouts/common.css') }}" />
    @yield('css')

</head>

<body>

    <header class="header @yield('header-class')">
        <div class="header__inner">

            <h1 class="header__title">
                <a href="{{ route('contact.index') }}" class="header__title-text">FashionablyLate</a>
            </h1>

            <div class="header__button">
                @yield('button')
            </div>

        </div>
    </header>

    <main class="content">

        @if(trim($__env->yieldContent('title')))
            <div class="content__title">
                <h2 class="content__title-text">
                    @yield('title')
                </h2>
            </div>
        @endif

        @yield('content')

    </main>

</body>

</html>
