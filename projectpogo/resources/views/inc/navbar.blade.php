<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                <a class="nav-link" href="/">Home <span class="sr-only"></span></a>
              </li>
              @if(!Auth::guest())
                @if(Auth::user()->isAdmin())
                <li class="nav-item ">
                    <a class="nav-link" href="{{route('admin')}}">Admin Dashboard <span class="sr-only"></span></a>
                </li>
                @endif
              @endif

              <li class="nav-item ">
                  <a class="nav-link" href="/posts">Posts <span class="sr-only"></span></a>
              </li>

              <li class="nav-item ">
                    <a class="nav-link" href="/profiles">Players <span class="sr-only"></span></a>
                </li>
              
              <ul class="nav navbar-nav navbar-right">
            @auth
                  <li class="nav-item ">
                      <a class="nav-link" href="/posts/create">Create Post <span class="sr-only"></span></a>
                  </li>

                  <li class="nav-item ">
                        <a class="nav-link" href="/profiles/create">Create Profile <span class="sr-only"></span></a>
                    </li>
              </ul>
            </ul>
           @endauth

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @if(Auth::guest())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    <li class="nav-item">
                        @if (Route::has('register'))
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            
                            <a class="dropdown-item" href="/dashboard/">Posts Overview</a>
                            <a class="dropdown-item" href="/playerdashboard/">Profiles Overview</a>
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
                @endif
            </ul>
        </div>
    
</nav>