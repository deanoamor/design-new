<!doctype html>
<html lang="en">

<head>
    <title>Home</title>
    @include('main.member.templates.member-base')
</head>

<body>
    <header>
        @include('main.member.templates.member-header')
    </header>
    <section>
        <!-- container : wajib utnuk membuat margin -->
        @include('sweetalert::alert')
        <div class="container">

            <!-- Breadcrumb -->
            <div class="row" style="margin-top: 45px;">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('member.home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Shopping Cart {{$member->username}}</li>
                    </ol>
                </nav>
            </div>
            <!-- end breadcrumb -->


            <!--Content-->
            <div class="container">
                <div class="row">
                    <h5 class="text-start" style="margin-top: 32px;">Shopping Cart</h5>

                    @if($cart->isNotEmpty())

                    @foreach($cart as $cartDesign)

                    <div class="card mt-3" style="padding: 10px;">
                        <div class="row">
                            <div class="col">
                                <a href="{{ route('member.detail-design', ['id' =>$cartDesign->Posting->id]) }}">
                                    <img src="{{ asset($cartDesign->Posting->image_url) }}" class="card-img-top" alt="..." style="width:150px;height:150px;">
                                </a>
                            </div>
                            <div class="col">
                                <h5>{{$cartDesign->Posting->title}}</h5>
                                <h5 style="margin-top: 12px;">{{$cartDesign->Posting->price}}</h5>
                            </div>

                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Select
                                    </label>
                                </div>
                                <form action="{{ route('member.cart.delete')}}" onclick="return confirm('Sure?');" method="post">
                                    {{csrf_field()}}
                                    <input class="form-control" type="hidden" name="id" value="{{$cartDesign->id}}">
                                    <button type="submit" style="color: grey;" class="btn btn-link">Remove from cart</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    @endforeach
                    <a href="Payment.html" style="margin-top: 32px;" class="btn btn-primary active" role="button" data-bs-toggle="button" aria-pressed="true">Buy Now</a>

                    @else
                    <div class="col-12 mt-4">
                        <div class="alert alert-danger justify-content-between" role="alert">
                            <h4 class="alert-heading basefont">Data Not Available</h4>
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>


    </section>

    <footer class="footer">
        @include('main.member.templates.member-footer')

        @include('main.member.templates.member-basefoot')
    </footer>
</body>

</html>