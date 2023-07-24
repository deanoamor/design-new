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
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('member.detail-design', ['id' => $posting->id]) }}">Detail Design ( {{$posting->title}} )</a></li>
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
                            <dd class="col-sm-3" style="position: text-start;">{{$posting->title}}</dd>
                            <dt class="col-sm-9">RP {{$posting->price}}</dt>

                            <dl class="row" style="margin-top: 10px;">
                                <dd class="col-sm-3">Total Payment</dd>
                                <dt class="col-sm-9">Rp {{$posting->price}}</dt>
                                <form action="{{ route('member.checkout.without-cart.create')}}" method="post">
                                    {{csrf_field()}}
                                    <input class="form-control" type="hidden" name="id" value="{{ $posting->id}}">
                                    <div class="d-grid gap-2" style="margin-top: 32px;">
                                        <button type="submit" class="btn btn-primary active">Continue to Pay</button>
                                    </div>
                                </form>
                    </div>
                    <!-- end address information section -->


                    <!-- order summary section -->
                    <div class="col" style="border-color: gainsboro; border-style: solid; border-width: 2px; border-radius: 10px; padding: 20px; margin: 10px;">
                        <h5 class="text-start">Order summary</h5>

                        <!-- card 1 -->
                        <div class="card mt-3" style="padding: 10px;">
                            <div class="row">
                                <div class="col">
                                    <img src="{{ asset($posting->image_url) }}" class="card-img-top" alt="..." style="width:100px;height:100px;">
                                </div>
                                <div class="col">
                                    <h6>{{$posting->title}}</h6>
                                    <p style="color: gray;">{{$posting->type}}</p>
                                    <p>RP {{$posting->price}}</p>
                                </div>
                            </div>
                        </div>
                        <!-- end card 1 -->

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