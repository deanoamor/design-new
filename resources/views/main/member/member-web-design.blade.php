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

            <!-- hero-->
            <div class="row" style="margin-top: 50px">

                <div class="row">
                    <h1 class="text-center">Web Design</h1>
                </div>

                <!-- search -->
                <div class="row mt-4 justify-content-center">
                    <form class="d-flex mt-4" action="{{ route('member.home.web-design.search') }}" method="GET">
                        <input type="text" class="form-control" name="search" placeholder="Search Design Asset" aria-label="Recipient's username" aria-describedby="button-addon2" />
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">
                            Search
                        </button>
                    </form>
                </div>
                <!-- end search -->

            </div>
            <!-- end hero-->

            <!-- Website design -->
            <div>

                <!-- row 2.2 -->
                <div class="row" style="margin-top: 20px">

                    @if($posting->isNotEmpty())

                    @foreach($posting as $postingWeb)

                    <!-- col 1 -->
                    <div class="col">
                        <!-- card 1 -->
                        <div class="card" style="width: 18rem; border: none;">
                            <a href="{{ route('member.detail-design', ['id' => $postingWeb->id]) }}">
                                <img src="{{ asset('storage/design/' . $postingWeb->image_name) }}" class="card-img-top" alt="..." style="width:300px;height:250px;border-style: solid; border-width: 2px; border-color: #E7E9EB;">
                            </a>
                            <div class="card-body mt-3" style="padding: 0px;">
                                <div class="row">
                                    <div class="col">
                                        <p>
                                            <img src="{{ asset($postingWeb->Member->image_url) }}" style="width:40px;height:40px;" class="rounded-circle"> <span class="ms-1">{{$postingWeb->Member->username}}</span>
                                        </p>
                                    </div>
                                    <div class="col align-self-center" style="text-align: end;">
                                        <p><i class="fa-sharp fa-regular fa-heart"></i>{{ $postingWeb->like}}
                                            <span class="ms-2"><i class="fa-regular fa-message"></i>{{ $postingWeb->feedback}}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card 1 -->

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

        </div>
        <!-- end Web design -->


    </section>


    <footer class="footer">
        @include('main.member.templates.member-footer')

        @include('main.member.templates.member-basefoot')
    </footer>
</body>

</html>