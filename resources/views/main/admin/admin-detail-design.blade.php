<!doctype html>
<html lang="en">

<head>
    <title>Home</title>
    @include('main.admin.templates.admin-base')
</head>

<body>
    <header>
        @include('main.admin.templates.admin-header')
    </header>

    <section>
        <!-- container : wajib utnuk membuat margin -->
        @include('sweetalert::alert')
        <div class="container">

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
                                <h5 class="text-start">{{ $posting->title}} ({{ $posting->id}})</h5>
                                <h6 class="text-start" style="margin-top: 20px;">Designer</h6>
                                <div style="justify-content: space-between; display:flex;">
                                    <div>
                                        <img src="{{ asset($posting->Member->image_url) }}" style="width:40px;height:40px;" class="rounded-circle"> <span class="ms-1">{{ $posting->Member->username}}</span>
                                    </div>

                                </div>

                                <h6 style="margin-top: 20px; text-align:left">{{ $posting->created_at}}</h6>
                                <p style="margin-top: 20px; text-align:left">{{ $posting->description}}</p>
                                <p style="margin-top: 20px; text-align:left"> <strong>Price Rp {{ $posting->formattedPrice}}</strong></p>

                                <p class="text-start" style="margin-top: 40px;">

                                    <i class="fa-solid fa-heart"></i> {{$posting->like}}<span class="ms-1"></span>
                                    <i class="fa-solid fa-message"></i>{{$posting->feedback}} <span class="ms-1"></span>
                                    <i class="fa-solid fa-download"></i>{{$posting->download}} <span class="ms-1"></span>
                                </p>
                                <form action="{{ route('admin.detail-design.design-posting.delete')}}" onclick="return confirm('sure?');" method="post">
                                    {{csrf_field()}}
                                    <input class="form-control" type="hidden" name="id" value="{{$posting->id}}">
                                    <div class="d-grid gap-2" style="margin-top: 75px;">
                                        <button type="submit" class="btn btn-outline-danger ms-3">Delete Post</button>
                                    </div>
                                </form>
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
        @include('main.admin.templates.admin-footer')

        @include('main.admin.templates.admin-basefoot')
    </footer>
</body>


</html>