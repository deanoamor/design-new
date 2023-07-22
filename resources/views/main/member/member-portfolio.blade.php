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
                        <li class="breadcrumb-item active" aria-current="page">My Portfolio</li>
                    </ol>
                </nav>
            </div>
            <!-- end breadcrumb -->

            <!--Content-->
            <div class="container">

                <div class="row">
                    <h5 class="text-start" style="margin-top: 32px;">My Portfolio</h5>

                    <!-- row 1.2 -->
                    <div class="row" style="margin-top: 20px">
                        @if($posting->isNotEmpty())

                        @foreach($posting as $postingPort)

                        <!-- col 1 -->
                        <div class="col">

                            <!-- card 1 -->
                            <a href="Details.html">
                                <div class="card" style="width: 18rem; border: none;" href="Details.html">
                                    <a href="{{ route('member.detail-design', ['id' => $postingPort->id]) }}">
                                        <img src="{{ asset($postingPort->image_url) }}" class="card-img-top" alt="..." style="border-style: solid; border-width: 2px; border-color: #E7E9EB;">
                                    </a>
                                    <div class="card-body mt-3" style="padding: 0px;">
                                        <div class="row">
                                            <div class="col">
                                                <p>
                                                    <img src="{{ asset($postingPort->Member->image_url) }}" style="width:40px;height:40px;" class="rounded-circle"> <span class="ms-1">{{$postingPort->Member->username}}</span>
                                                </p>
                                            </div>
                                            <div class="col align-self-center" style="text-align: end;">
                                                <p><i class="fa-sharp fa-regular fa-heart"></i>{{ $postingPort->like}}
                                                    <span class="ms-2"><i class="fa-regular fa-message"></i>{{ $postingPort->feedback}}</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
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
            </div>

        </div>

    </section>

    <footer class="footer">
        @include('main.member.templates.member-footer')

        @include('main.member.templates.member-basefoot')
    </footer>
</body>

</html>