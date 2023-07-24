@auth()
@php( $member = \App\Models\Member::where('users_id',Auth::user()->id )->first() )
@else
@endauth

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <a href="{{ route('member.home') }}"><img src="{{ URL::asset('gambar/logo.png') }}" /></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        @auth()
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <a href="{{ route('member.design-posting') }}" class="btn btn-success me-4">Upload Design</a>
            <ul class="navbar-nav mb-2 mb-lg-0 me-2">
                <li class="nav-item me-3">
                    <a href="{{ route('member.ranking') }}"><i class="fa-sharp fa-solid fa-trophy"></i></a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('member.cart') }}"> <i class="fa-sharp fa-solid fa-cart-shopping"></i></a>
                </li>
            </ul>
            <div class="dropdown nav-item align-self-center nav-link ms-4">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Halo, {{$member->username}}
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('member.profile') }}">Profile</a></li>
                    <li><a class="dropdown-item" href="{{ route('member.portfolio') }}">My Portfolio</a></li>
                    <li><a href="{{ route('member.transaction-history') }}" class="dropdown-item">Transaction History</a></li>
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