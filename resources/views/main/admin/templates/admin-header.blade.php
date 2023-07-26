@auth()
@php( $admin = \App\Models\Admin::where('users_id',Auth::user()->id )->first() )
@else
@endauth

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <a href="{{ route('admin.home') }}"><img src="{{ URL::asset('gambar/logo.png') }}" /></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        @auth()
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <div class="dropdown nav-item align-self-center nav-link ms-4">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Halo, {{$admin->username}}
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">My dashboard</a></li>
                    <li><a class="dropdown-item" href="#">My dashboard</a></li>
                    <li><a class="dropdown-item" href="#">My dashboard</a></li>
                    <li>
                        <a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit()">Sign
                            Out</a>
                        <form id="logout-form" action="{{route('logout')}}" method="post" style="display: none">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        @else
        <div>
            <a href="{{route('login')}}" class="btn btn-primary">Sign In</a>
        </div>
        @endauth
    </div>
</nav>