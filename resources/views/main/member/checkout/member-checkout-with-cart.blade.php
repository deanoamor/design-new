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
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('member.cart') }}">Shopping Cart {{$member->username}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                    </ol>
                </nav>
            </div>
            <!-- end breadcrumb -->


            <!--Content-->
            <div class="container">

                <div class="row">

                    <!-- address information section -->
                    <div class="col" style="border-color: gainsboro; border-style: solid; border-width: 2px; border-radius: 10px; padding: 20px; margin: 10px;">
                        <h5 class="text-start">Address Information</h5>
                        <!--End Form Line 3-->

                        <dl class="row" style="margin-top: 24px;">

                            @if($cart->isNotEmpty())

                            @foreach($cart as $cartList)
                            <dd class="col-sm-3" style="position: text-start;">{{$cartList->Posting->title}}</dd>
                            <dt class="col-sm-9">Rp {{$cartList->Posting->formattedPrice}}</dt>
                            @endforeach

                            @else
                            <div class="col-12 mt-4">
                                <div class="alert alert-danger justify-content-between" role="alert">
                                    <h4 class="alert-heading basefont">Data Not Available</h4>
                                </div>
                            </div>
                            @endif

                            <dl class="row" style="margin-top: 10px;">
                                <dd class="col-sm-3">Total Payment</dd>
                                <dt class="col-sm-9">Rp {{number_format($cartSum)}}</dt>
                                <form action="{{ route('member.checkout.with-cart.create')}}" method="post">
                                    {{csrf_field()}}
                                    <input class="form-control" type="hidden" name="totalPayment" value="{{$cartSum}}">
                                    <div class="d-grid gap-2" style="margin-top: 32px;">
                                        <button type="submit" class="btn btn-primary active">Continue to Pay</button>
                                    </div>
                                </form>
                    </div>
                    <!-- end address information section -->


                    <!-- order summary section -->
                    <div class="col" style="border-color: gainsboro; border-style: solid; border-width: 2px; border-radius: 10px; padding: 20px; margin: 10px;">
                        <h5 class="text-start">Order summary</h5>

                        @if($cart->isNotEmpty())

                        @foreach($cart as $cartList)

                        <!-- card 1 -->
                        <div class="card mt-3" style="padding: 10px;">
                            <div class="row">
                                <div class="col">
                                    <img src="{{ asset($cartList->Posting->image_url) }}" class="card-img-top" alt="..." style="width:100px;height:100px;">
                                </div>
                                <div class="col">
                                    <h6>{{$cartList->Posting->title}}</h6>
                                    <p style="color: gray;">{{$cartList->Posting->type}}</p>
                                    <p>RP {{$cartList->Posting->formattedPrice}}</p>
                                </div>
                                <form action="{{ route('member.checkout.with-cart.set-select')}}" onclick="return confirm('Sure?');" method="post">
                                    {{csrf_field()}}
                                    <input class="form-control" type="hidden" name="id" value="{{$cartList->id}}">
                                    <button type="submit" style="color: grey;" class="btn btn-link">Remove from checkout</button>
                                </form>
                            </div>
                        </div>
                        <!-- end card 1 -->
                        @endforeach

                        @else
                        <div class="col-12 mt-4">
                            <div class="alert alert-danger justify-content-between" role="alert">
                                <h4 class="alert-heading basefont">Data Not Available</h4>
                            </div>
                        </div>
                        @endif

                    </div>
                    <!-- end order summary section -->

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