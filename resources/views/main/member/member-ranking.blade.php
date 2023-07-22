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
        <div class="container">

            <!-- Breadcrumb -->
            <div class="row" style="margin-top: 45px;">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('member.home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Rangking</li>
                    </ol>
                </nav>
            </div>
            <!-- end breadcrumb -->

            <h5 class="text-start" style="margin-top: 50px;">Top Rangking</h5>

            <!--Content-->
            <div class="row mt-3">
                <div class="col">

                    <!-- Content 1 -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="text-start">Total Likes</h5>

                            @if($postingLike->isNotEmpty())

                            @foreach($postingLike as $likeList)

                            <!-- card 1 -->
                            <div class="card mt-3" style="padding: 10px;">
                                <div class="col" style="display:flex; justify-content:space-between;">
                                    <div class="align-items-center " style="display:flex;">
                                        <a href="{{ route('member.detail-design', ['id' =>$likeList->id]) }}">
                                            <img src="{{ asset($likeList->image_url) }}" class="card-img-top" alt="..." style="width: 3rem;">
                                        </a>
                                        <h5 class="ms-3">{{ $likeList->title}}</h5>
                                    </div>
                                    <p class="my-auto">{{ $likeList->like}} likes</p>
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
                    </div>

                </div>

                <!-- end Content 1 -->


                <!-- Content 2 -->
                <div class="col">

                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="text-start">Total Downloads</h5>

                            @if($postingDownload->isNotEmpty())

                            @foreach($postingDownload as $downloadList)

                            <!-- card 1 -->
                            <div class="card mt-3" style="padding: 10px;">
                                <div class="col" style="display:flex; justify-content:space-between;">
                                    <div class="align-items-center " style="display:flex;">
                                        <a href="{{ route('member.detail-design', ['id' =>$downloadList->id]) }}">
                                            <img src="{{ asset($downloadList->image_url) }}" class="card-img-top" alt="..." style="width: 3rem;">
                                        </a>
                                        <h5 class="ms-3">{{ $downloadList->title}}</h5>
                                    </div>
                                    <p class="my-auto">{{ $downloadList->download}} Downloads</p>
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
                    </div>

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