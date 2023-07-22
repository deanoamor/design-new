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

            <!-- row 1.1 -->
            <div class="row" style="margin-top: 45px;">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('member.home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Design ( {{ $posting->title}} )</li>
                    </ol>
                </nav>
            </div>
            <!-- end row 1.1 -->

            <!--Content-->
            <div class="container text-center">
                <div class="row" style="margin-top: 20px;">

                    <!-- card 1 -->
                    <div class="col">
                        <img src="{{ asset($posting->image_url) }}" class="" alt="..." style="width: 25rem;">
                        <div class="card-body mt-1" style="padding: 10px;">
                        </div>
                    </div>
                    <!-- end card 1 -->

                    <!-- card 2 -->
                    <div class="col">
                        <div class="card mb-3">
                            <div class="card-body" style="padding: 20px;">
                                <h5 class="text-start">{{ $posting->title}}</h5>
                                <h6 class="text-start" style="margin-top: 20px;">Designer</h6>
                                <div style="justify-content: space-between; display:flex;">
                                    <div>
                                        <img src="{{ asset($posting->Member->image_url) }}" style="width:40px;height:40px;" class="rounded-circle"> <span class="ms-1">{{ $posting->Member->username}}</span>
                                    </div>

                                    @if ($posting->members_id == $loginId)
                                    <div style="justify-content: space-between; display:flex;">
                                        <a type="button" class="btn btn-outline-primary" href="{{ route('member.design-posting.edit', ['id' => $posting->id]) }}">Edit Post</a>
                                        <a type="button" class="btn btn-outline-danger ms-3" onclick="return confirm('sure?');" href="{{ route('member.detail-design.design-posting.delete', ['id' => $posting->id]) }}">Delete Post</a>
                                    </div>
                                    @else
                                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#reportModal">Write Report</button>
                                    @endif

                                </div>

                                <h6 style="margin-top: 20px; text-align:left">{{ $posting->created_at}}</h6>
                                <p style="margin-top: 20px; text-align:left">{{ $posting->description}}</p>

                                <p class="text-start" style="margin-top: 40px;">
                                    @if ($like)
                                    <a href="{{ route('member.detail-design.like.create', ['id' => $posting->id]) }}"><i class="fa-solid fa-heart"></i></a>
                                    @else
                                    <a href="{{ route('member.detail-design.like.create', ['id' => $posting->id]) }}"><i class="fa-sharp fa-regular fa-heart"></i></a>
                                    @endif

                                    {{$posting->like}}<span class="ms-1"></span>
                                    <i class="fa-solid fa-message"></i>{{$posting->feedback}} <span class="ms-1"></span>
                                    <i class="fa-solid fa-download"></i>123 <span class="ms-1"></span>
                                    <i class="fa-solid fa-share"></i>123 <span class="ms-1"></span>
                                </p>

                                <div class="d-grid gap-2" style="margin-top: 75px;">
                                    <a href="Payment.html" class="btn btn-primary active" role="button" data-bs-toggle="button" aria-pressed="true">Buy design (Rp 5000)</a>
                                    @if ($cart)
                                    <button class="btn btn-outline-primary" type="button" disabled>This design already in your cart</button>
                                    @else
                                    <a href="{{ route('member.detail-design.cart.create', ['id' => $posting->id]) }}" class="btn btn-outline-primary" type="button">Add to Cart</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- end card 2 -->

                    <!-- Comment Section -->
                    <div class="row">
                        <div class="col">
                            <div class="card mb-3" style="width: 45rem;">
                                <div class="card-body">
                                    <h5 class="text-start">Feedback</h5>

                                    @error('text')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror

                                    <!-- form Comment Section -->
                                    <form action="{{ route('member.detail-design.feedback.create')}}" method="post">
                                        {{csrf_field()}}
                                        <input class="form-control" type="hidden" name="id" value="{{ $posting->id}}">
                                        <p class="text-start" style="margin-top: 20px;">
                                            <span class="form-floating">
                                                <div class="form-floating">
                                                    <textarea class="form-control" name="text" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                                                    <label for="floatingTextarea2">Give a polite feedback here..</label>
                                                </div>
                                            </span>
                                        </p>
                                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                            <button class="btn btn-outline-primary" type="submit">Send Feedback</button>
                                        </div>
                                    </form>
                                    <!-- end form Comment Section -->
                                </div>

                                @if($feedback->isNotEmpty())

                                @foreach($feedback as $feed)
                                <div class="card mt-3" style="margin:20px">
                                    <div class="col" style="display:flex; justify-content:space-between;margin: 20px;">
                                        <div style="display:flex;">
                                            <img src="{{ asset($feed->Member->image_url) }}" class="card-img-top" alt="..." style="width:40px;height:40px;">
                                            <h5 class="ms-3">{{ $feed->Member->username}} </h5>

                                            @if ($feed->members_id == $posting->members_id)
                                            <h5 class="ms-3"><span class="badge bg-primary">Owner</span></h5>
                                            @endif

                                        </div>
                                        <div style="display:flex;">
                                            <p class="ms-3">{{ $feed->created_at}}</p>

                                            @if ($feed->members_id == $loginId)
                                            <form action="{{ route('member.detail-design.feedback.delete')}}" onclick="return confirm('sure?');" method="post">
                                                {{csrf_field()}}
                                                <input class="form-control" type="hidden" name="id" value="{{$feed->id}}">
                                                <button class="ms-3" type="submit"><i class="fa-solid fa-trash" style="color: red;"></i></button>
                                            </form>
                                            @endif

                                        </div>
                                    </div>
                                    <p style="text-align:left; margin-left: 20px; margin-right: 20px">{{ $feed->text}}</p>
                                </div>
                                @endforeach

                                @else

                                <div class="col-12 mt-4">
                                    <div class="alert alert-danger justify-content-between" role="alert">
                                        <h4 class="alert-heading basefont">Comment Not Available</h4>
                                    </div>
                                </div>

                                @endif

                            </div>
                        </div>
                    </div>
                    <!-- End Comment Section -->

                </div>
            </div>
        </div>
        <!-- End container -->

    </section>


    <footer class="footer">
        @include('main.member.templates.member-footer')

        @include('main.member.templates.member-basefoot')
    </footer>
</body>

@include('main.member.modal.member-modal-report')


</html>