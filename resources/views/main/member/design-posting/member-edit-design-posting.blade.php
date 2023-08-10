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
                        <li class="breadcrumb-item active" aria-current="page">Edit Design ({{ $posting->title}})</li>
                    </ol>
                </nav>
            </div>
            <!-- end breadcrumb -->

            <div>
                <!-- Upload File Wording -->
                <div class="row" style="margin-top: 50px">
                    <h5 style="grid-row-start: auto;">Upload Your Design</h5>
                </div>
                <!-- end Upload File Wording -->

                <!--Content-->
                <form action="{{ route('member.design-posting.update')}}" enctype="multipart/form-data" method="post">
                    {{csrf_field()}}
                    <div class="container">
                        <input class="form-control" type="hidden" name="id" value="{{$posting->id}}">
                        <div class="row">
                            <div class="mt-4">
                                <label for="formFileLg" class="form-label">Design</label>
                                <input class="form-control form-control-lg" name="image_url" type="file">
                                @error('image_url')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <p>Curent design : {{ $posting->image_name}}</p>
                                <img src="{{ asset($posting->image_url) }}" class="card-img-top" alt="..." style="width: 10rem;">
                            </div>

                            <div class="mt-4">
                                <label for="formFileLg" class="form-label">FIle</label>
                                <input class="form-control form-control-lg" name="file_url" type="file">
                                @error('file_url')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <p>Curent file : {{ $posting->file_name}}</p>
                                <img src="{{ asset($posting->file_url) }}" class="card-img-top" alt="..." style="width: 10rem;">
                            </div>

                            <!-- Premium or Free -->
                            <div class="col mt-4" style="border-color: gainsboro; border-style: solid; border-width: 1px; border-radius: 10px; padding: 20px; margin: 10px;">
                                <h5 class="text-start">Premium or Free</h5>

                                <div class="form-check" style="margin-top: 32px;">
                                    <input class="form-check-input" type="radio" value="0" name="is_free" required {{ ($posting->is_free=="0")? "checked" : "" }}>
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        <h5>Premium Pack</h5>
                                    </label>
                                    <p style="margin-top: 12px;">This is a premium pack, I want to sell on the Norin Marketplace.</p>
                                </div>

                                <div class="form-check" style="margin-top: 32px;">
                                    <input class="form-check-input" type="radio" value="1" name="is_free" required {{ ($posting->is_free=="1")? "checked" : "" }}>
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        <h5>Free Pack</h5>
                                    </label>
                                    <p style="margin-top: 12px;">This is a free pack that I want to offer for free on the Norin Marketplace.</p>
                                </div>
                            </div>
                        </div>

                        <!-- End Premium or Free -->


                        <!-- Pack Details -->

                        <div class="row">

                            <div class="col" style="border-color: gainsboro; border-style: solid; border-width: 1px; border-radius: 10px; padding: 20px; margin: 10px;">
                                <h5 class="text-start">Pack Details</h5>

                                <div class="mb-2" style="margin-top: 32px;">
                                    <label for="exampleFormControlInput1" class="form-label">Name Pack</label>
                                    <input type="text" class="form-control" name="title" value="{{ $posting->title}}" placeholder="Pick a name that describes the topic of your pack e.g Avatar, School & education, UI controls." required>
                                </div>

                                <div class="mb-3" style="margin-top: 32px;">
                                    <label for="exampleFormControlTextarea1" class="form-label">Pack Description</label>
                                    <textarea class="form-control" name="description" rows="3" placeholder="Use this field to provide additional information on how to get the most of this pack" required>{{ $posting->description}}</textarea>
                                </div>

                                <div class="mb-2" style="margin-top: 32px;">
                                    <label for="exampleFormControlInput1" class="form-label">Pricing per Pack <strong>(automatically 0 if this design is free)</strong></label>
                                    <input type="text" class="form-control" name="price" value="{{ $posting->price}}" placeholder="e.g: Rp10.000" required>
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col mt-4" style="border-color: gainsboro; border-style: solid; border-width: 1px; border-radius: 10px; padding: 20px; margin: 10px;">
                                <h5 class="text-start">Type</h5>

                                <div class="form-check" style="margin-top: 32px;">
                                    <input class="form-check-input" type="radio" value="illustration" name="type" required {{ ($posting->type=="illustration")? "checked" : "" }}>
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        <h5>Illustration</h5>
                                    </label>
                                </div>


                                <div class="form-check" style="margin-top: 32px;">
                                    <input class="form-check-input" type="radio" value="webDesign" name="type" required {{ ($posting->type=="webDesign")? "checked" : "" }}>
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        <h5>Web Design</h5>
                                    </label>
                                </div>

                            </div>
                        </div>
                        <!-- End Pack Details -->

                        <div class="d-grid gap-2" style="margin-top: 32px;">
                            <button type="submit" style="background-color: #4F7AF6;" class="btn btn-primary">Update Design</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>

    </section>

    <footer class="footer">
        @include('main.member.templates.member-footer')

        @include('main.member.templates.member-basefoot')
    </footer>
</body>

</html>