<!doctype html>
<html lang="en"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>{{$title ?? __('misc.default_page_title')}}</title>

    <!-- Bootstrap core CSS -->
    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/offcanvas.css">
    <!-- Favicons -->


</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-purple">
    <a class="navbar-brand mr-5" href="{{route('posts.index')}}">LaraBlog</a>
    <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item {{--active--}}">
                <a class="nav-link {{--text-white--}}" href="#">Пункт меню 1</a>
            </li>
            {{--<li class="nav-item">
                <a class="nav-link text-white" href="#">Пункт меню 2</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="#">Пункт меню 3</a>
            </li>--}}
            @can('create_post')
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{route('posts.create')}}">Добавить пост</a>
                </li>
            @endcan

            <!--<li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Settings</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>-->
        </ul>
        <ul class="navbar-nav ml-auto text-right">
            <!--<li class="nav-item">
                <a class="nav-link" href="#">Пункт меню 6</a>
            </li>-->

            @guest
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{route('register')}}">Регистрация</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{route('login')}}">Войти</a>
                </li>
            @endguest
            @auth
                <li class="nav-item">
                    <a class="nav-link text-white" style="text-decoration: underline" href="{{route('user.show', \Auth::user())}}">{{\Auth::user()->name}}</a>
                </li>
                <li class="nav-item">
                    <form action="{{route('logout')}}" METHOD="POST" id="logout-form">
                        @csrf
                        <a type="submit" class="nav-link text-white" id="logout-link" href="{{route('logout')}}">Выйти</a>
                    </form>
                </li>
            @endauth
        </ul>
    </div>
</nav>

<!--Additional menu-->
<!--<div class="bg-white shadow-sm">
    <nav class="nav nav-underline">
        <a class="nav-link active" href="#">Dashboard</a>
        <a class="nav-link" href="#">
            Friends
            <span class="badge badge-pill bg-light align-text-bottom">27</span>
        </a>
        <a class="nav-link" href="#">Explore</a>
        <a class="nav-link" href="#">Suggestions</a>
        <a class="nav-link" href="#">Link</a>
    </nav>
</div>-->

<main role="main" class="container">
    @if($errors->count())
        <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-danger rounded shadow-sm">
            <div class="lh-100">
                <h6 class="mb-0 text-white lh-100">{{$errors->first()}}</h6>
            </div>
        </div>
    @endif

    @if(session('success'))
    <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-success rounded shadow-sm">
        <div class="lh-100">
            <h6 class="mb-0 text-white lh-100">Место под уведомления</h6>
        </div>
    </div>
    @endif

    @yield('content')

</main>

<!-- JS, Popper.js, and jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script src="{{asset('js/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('js/scripts.js')}}"></script>
<script>
    jQuery('document').ready(function ($) {
        $('#logout-link').click(function (e) {
            e.preventDefault();
            $('#logout-form').submit();
        })
        $('.destroy-post').click(function (e) {
            e.preventDefault();
            if ( confirm('{{__('post.delete_confirmation')}}') ) {
                this.parentElement.submit();
            }
        })
        if ($('textarea#content').length) {
            CKEDITOR.replace('content')
        }
    })
</script>
</body></html>
