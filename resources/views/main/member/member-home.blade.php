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
        @include('sweetalert::alert')
        <!-- container : wajib utnuk membuat margin -->
        <div class="container">

            <!-- hero-->
            <div class="row" style="margin-top: 50px">

                <div class="row">
                    <h1 class="text-center">Find Your Design Assets</h1>
                </div>
                <div class="row">
                    <h6 class="text-center">
                        Browse to find the design that fit your needs and click to download
                    </h6>
                </div>

                <!-- search -->
                <div class="row mt-4 justify-content-center">
                    <form class="d-flex mt-4" action="{{ route('member.home.search') }}" method="GET">
                        <input type="text" class="form-control" name="search" placeholder="Search Design Asset" aria-label="Recipient's username" aria-describedby="button-addon2" />
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">
                            Search
                        </button>
                    </form>
                </div>
                <!-- end search -->

            </div>
            <!-- end hero-->

            <!-- Illustration -->
            <div>
                <!-- row 1.1 -->
                <div class="row" style="margin-top: 50px">
                    <h6>Illustration</h6>
                    <p>Give your designs a personal touch</p>
                </div>
                <!-- end row 1.1 -->

                <!-- row 1.2 -->
                <div class="row" style="margin-top: 20px">
                    @if($postingIllustration->isNotEmpty())

                    @foreach($postingIllustration as $illustration)

                    <!-- col 1 -->
                    <div class="col">
                        <!-- card 1 -->

                        <div class="card" style="width: 18rem; border: none;">
                            <a href="{{ route('member.detail-design', ['id' => $illustration->id]) }}">
                                <img src="{{ asset($illustration->image_url) }}" class="card-img-top" alt="..." style="border-style: solid; border-width: 2px; border-color: #E7E9EB;">
                            </a>
                            <div class="card-body mt-3" style="padding: 0px;">
                                <div class="row">
                                    <div class="col">
                                        <p>
                                            <img src="{{ asset($illustration->Member->image_url) }}" style="width:40px;height:40px;" class="rounded-circle"> <span class="ms-1">{{$illustration->Member->username}}</span>
                                        </p>
                                    </div>
                                    <div class="col align-self-center" style="text-align: end;">
                                        <p><i class="fa-sharp fa-regular fa-heart"></i>{{ $illustration->like}}
                                            <span class="ms-2"><i class="fa-regular fa-message"></i>{{ $illustration->feedback}}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- end card 1 -->
                    </div>
                    <!-- end col 1 -->

                    @endforeach

                    @else
                    <div class="col-12 mt-4">
                        <div class="alert alert-danger justify-content-between" role="alert">
                            <h4 class="alert-heading basefont">Data Not Available</h4>
                        </div>
                    </div>
                    @endif

                </div>
                <!-- end row 1.2 -->
            </div>
            <!-- end Illustration -->

            <!-- Website design -->
            <div>

                <!-- row 2.1 -->
                <div class="row" style="margin-top: 50px">
                    <h6>Web Design</h6>
                    <p>Bring depth to your designs</p>
                </div>
                <!-- end row 2.1 -->

                <!-- row 2.2 -->
                <div class="row" style="margin-top: 20px">

                    @if($postingWebDesign->isNotEmpty())

                    @foreach($postingWebDesign as $webDesign)

                    <!-- col 1 -->
                    <div class="col">
                        <!-- card 1 -->
                        <div class="card" style="width: 18rem; border: none;">
                            <a href="{{ route('member.detail-design', ['id' => $webDesign->id]) }}">
                                <img src="{{ asset($webDesign->image_url) }}" class="card-img-top" alt="..." style="border-style: solid; border-width: 2px; border-color: #E7E9EB;">
                            </a>
                            <div class="card-body mt-3" style="padding: 0px;">
                                <div class="row">
                                    <div class="col">
                                        <p>
                                            <img src="{{ asset($webDesign->Member->image_url) }}" style="width:40px;height:40px;" class="rounded-circle"> <span class="ms-1">{{$webDesign->Member->username}}</span>
                                        </p>
                                    </div>
                                    <div class="col align-self-center" style="text-align: end;">
                                        <p><i class="fa-sharp fa-regular fa-heart"></i>{{ $webDesign->like}}
                                            <span class="ms-2"><i class="fa-regular fa-message"></i>{{$webDesign->feedback}}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end card 1 -->
                    </div>
                    <!-- end col 1 -->

                    @endforeach

                    @else
                    <div class="col-12 mt-4">
                        <div class="alert alert-danger justify-content-between" role="alert">
                            <h4 class="alert-heading basefont">Data Not Available</h4>
                        </div>
                    </div>
                    @endif

                </div>
                <!-- end row 2.2 -->

            </div>
            <!-- end Web design -->
        </div>


    </section>

    <footer class="footer">
        @include('main.member.templates.member-footer')

        @include('main.member.templates.member-basefoot')
    </footer>
</body>

</html>