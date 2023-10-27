<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>BBC - system czasu pracy</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
  @stack('scripts')
<!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('front/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('front/css/custom.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    
  <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
@yield('css')
</head>
<body>
   
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-secondary shadow-sm">
            <div class="container" >
        
            
                <a class="navbar-brand mx-auto" href="{{ url('/home') }}" >
              
                    <img class="img-fluid mx-auto d-block" src="{{URL::asset('bbc.png')}}" alt="" width="55" height="25"  >  
                
                   
                </a>
 
                
                
                <button class="navbar-toggler ml-auto" style="margin: auto;" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon" display= "table"></span>
  </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">

                </ul>

                    <!-- Center Side Of Navbar -->
                   
                <ul class="nav justify-content-end">
                <ul class="navbar-nav mx-auto ">
                        <!-- Authentication Links -->
                        @guest
                   
                        @else
     
              
            
                @if(Auth::User()->permissions == 'Pracownik')
                <li class="nav-item active">
                <a class="nav-link px-4" href="{{ url('home') }}">
                {{ __('Raporty') }}
                </a>
                </li>
                @endif
                @if(Auth::User()->permissions == 'Pracownik')
                <li class="nav-item active">
                <a class="nav-link px-4" href="{{ url('home/vacations') }}">
                {{ __('Urlopy') }}
                </a>
                </li>
                @endif
                @if(Auth::User()->permissions == 'Pracownik')
                <li class="nav-item active">
                <a class="nav-link px-4" href="{{ url('home/month_end_closing') }}">
                {{ __('Deklaracje') }}
                </a>
                </li>
                @endif
                @if(Auth::User()->permissions == 'Administrator')
                <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle px-4" data-bs-toggle="dropdown">Zasoby</a>
                        <div class="dropdown-menu">
                            <a href="{{ url('register') }}" class="dropdown-item">Użytkownicy</a>
                            <div class="dropdown-divider"></div>
                            <a href="{{ url('home/customers') }}" class="dropdown-item">Klienci</a>
                            <div class="dropdown-divider"></div>
                            <a href="{{ url('home/tasks') }}" class="dropdown-item">Projekty</a>
                            
                        </div>
                    </li>
                @endif
                @if(Auth::User()->permissions == 'Administrator')
                <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle px-4" data-bs-toggle="dropdown">Raporty</a>
                        <div class="dropdown-menu">
                            <a href="{{ url('/home') }}" class="dropdown-item">Dodaj raport</a>
                            <div class="dropdown-divider"></div>
                            <a href="{{ url('home/reports') }}" class="dropdown-item">Raporty</a>
                            <div class="dropdown-divider"></div>
                            <a href="{{ url('home/day_reports') }}" class="dropdown-item">Raport dzienny</a>
                            <div class="dropdown-divider"></div>
                            <a href="{{ url('home/period_reports') }}"class="dropdown-item">Raport okresowy</a>
                        </div>
                    </li>
                @endif
        
                @if(Auth::User()->permissions == 'Administrator')
                <li class="nav-item dropdown">
                        <a href="{{ url('home/vacations') }}" class="nav-link dropdown-toggle px-4" data-bs-toggle="dropdown">Urlopy</a>
                        <div class="dropdown-menu">
                            <a href="{{ url('home/vacations') }}" class="dropdown-item">Zgłoś urlop</a>
                           
<div class="dropdown-divider"></div>
                            <a href="{{ url('home/confirm_vacations_reports') }}" class="dropdown-item">Potwierdzenia urlopów</a>
 <div class="dropdown-divider"></div>
                            <a href="{{ url('home/vacations_reports') }}" class="dropdown-item">Raporty urlopowe</a>
 <div class="dropdown-divider"></div>
                            <a href="{{ url('home/vacations_count') }}" class="dropdown-item">Liczba dni urlopu do  wykorzystania</a>
                        </div>
                        
                    </li>
                @endif
                   
                @if(Auth::User()->permissions == 'Administrator')
                <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle px-4" data-bs-toggle="dropdown">Deklaracje</a>
                        <div class="dropdown-menu">
                            <a href="{{ url('/home/month_end_closing') }}" class="dropdown-item">Zgłoś deklarację</a>
                            
                            <div class="dropdown-divider"></div>
                  
                            <a href="{{ url('/home/month_end_closing_kpir') }}" class="dropdown-item">KPiR</a>
                            
                            <div class="dropdown-divider"></div>
                            <a href="{{ url('/home/month_end_closing_kh') }}" class="dropdown-item">Księgi Handlowe</a>
                            
                        </div>

                    </li>
                @endif
                

       @if(Auth::User()->permissions == 'Administrator')
                <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle px-4" data-bs-toggle="dropdown">Obecność</a>
                        <div class="dropdown-menu">
                            <a href="{{ url('/home/plans') }}" class="dropdown-item">Dodaj obecność</a>
                            <div class="dropdown-divider"></div>
                            <a href="{{ url('/home/planlist') }}" class="dropdown-item">Lista obecności</a>

                        </div>

                    </li>
                @endif


   @if(Auth::User()->permissions == 'Pracownik')
                <li class="nav-item active">
                <a class="nav-link px-4" href="{{ url('home/plans') }}">
                {{ __('Obecność') }}
                </a>
                </li>
                @endif


                
                @if(Auth::User()->permissions == 'Administrator' || Auth::User()->permissions == 'Pracownik')
               
                <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle px-4" href="#" role="button" data-bs-toggle="dropdown">
                                    {{ Auth::user()->name }}  {{ Auth::user()->surname }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right " aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item text-center" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Wyloguj się') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @endif
                        @endguest
  </ul>
  </ul>
            </div>
            
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
