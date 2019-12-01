<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>IT Knowledge Sharing System</title>

    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/d3js/5.9.7/d3.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">


  

    <!-- Styles -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('css/fontawesome.css') }}" rel="stylesheet" type="text/css"> --}}
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <style>
        .chat {
          list-style: none;
          margin: 0;
          padding: 0;
        }
      
        .chat li {
          margin-bottom: 10px;
          padding-bottom: 5px;
          border-bottom: 1px dotted #B3A9A9;
        }
      
        .chat li .chat-body p {
          margin: 0;
          color: #777777;
        }
      
        .panel-body {
          overflow-y: scroll;
          height: 350px;
        }
      
        ::-webkit-scrollbar-track {
          -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
          background-color: #F5F5F5;
        }
      
        ::-webkit-scrollbar {
          width: 12px;
          background-color: #F5F5F5;
        }
      
        ::-webkit-scrollbar-thumb {
          -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
          background-color: #555;
        }
      </style>

      <!-- Scripts -->
        <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
            'pusherKey' => config('d1f838bf157779f3bf90'),
            'pusherCluster' => config('ap1')
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <div class="pr-3" style="border-right:1px solid #333">IT Knowledge Sharing System</div>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        {{-- {{ route('profile.index', auth()->user()->id) }} --}}
                    <li class="nav-item"><a href="/" class="nav-link active">Home</a></li>{{-- {{ route('home.index', auth()->user()->id }} --}}
                    <li class="nav-item"><a href="/consultant" class="nav-link">Seek Consultant</a></li>
                    <li class="nav-item"><a href="/onlinecourses" class="nav-link">Online Courses</a></li>
                    <li class="nav-item"><a href="/knowledgeMine" class="nav-link">Knowledge Mine</a></li>
                <li class="nav-item"><a href="/p/index" class="nav-link">Sharing Blog</a></li> {{-- {{ route('profile.index', auth()->user()->id) }} --}}
                    <li class="nav-item"><a href="{{ route('question.index')}}" class="nav-link">Bounty Q & A</a></li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->username }} <span class="caret"></span>
                                </a>
                                
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a href="{{ route('profile.index', [Auth::user()->id] ) }}" class="dropdown-item">My Profile</a>
                                    <a href="{{ route('profile.reportDocDetails', Auth::user()->id ) }}" class="dropdown-item">Report Details</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

<!-- Scripts --> 

<script src="{{ asset('js/app.js') }}"></script>
@yield('javascript')
</body>
</html>
