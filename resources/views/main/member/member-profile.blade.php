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

            <div class="row">

                <!-- address information section -->
                <div class="col" style="border-color: gainsboro; border-style: solid; border-width: 2px; border-radius: 10px; padding: 20px; margin: 10px;">
                    <h5 class="text-start">Information Profile</h5>

                    <!--Form Line 1-->
                    <form action="{{ route('member.profile.update')}}" enctype="multipart/form-data" method="post">
                        {{csrf_field()}}
                        <input class="form-control" type="hidden" name="id" value="{{$member->id}}">
                        <div class="mt-4">
                            <img src="{{ asset($member->image_url) }}" class="card-img-top" alt="..." style="width: 10rem;">
                            <input class="form-control form-control-lg" name="image_url" type="file">
                            @error('image_url')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            <p>Curent image : {{ $member->image_name}}</p>
                        </div>

                        <h6 style="margin-top: 32px;">Username</h6>
                        <div class="">
                            <input type="text" class="form-control" value="{{ $member->username}}" name="username">
                        </div>

                        <h6 style="margin-top: 32px;">Fullname</h6>
                        <div class="">
                            <input type="text" class="form-control" value="{{ $member->User->name}}" name="name">
                        </div>

                        <h6 style="margin-top: 32px;">Email</h6>
                        <div class="">
                            <input type="text" class="form-control" value="{{ $member->User->email}}" name="email">
                        </div>

                        <h6 style="margin-top: 32px;"></h6>Phone</h6>
                        <div class="">
                            <input type="text" class="form-control" value="{{ $member->no_hp}}" name="no_hp">
                        </div>

                        <div class="d-grid gap-2" style="margin-top: 32px;">
                            <button type="submit" style="background-color: #4F7AF6;" class="btn btn-primary">Update Profile</button>
                        </div>
                    </form>

                    <!--End Form Line 1-->

                </div>

                <!-- Money -->
                <div class="col" style="border-color: gainsboro; border-style: solid; border-width: 2px; border-radius: 10px; padding: 20px; margin: 10px;">
                    <h5 class="text-start">Your Money</h5>
                    <h4 class="text-start" style="margin-top: 22px;">Rp{{ $member->formattedWallet}}</h4>

                    <form action="{{ route('member.profile.wallet.update')}}" enctype="multipart/form-data" method="post">
                        {{csrf_field()}}
                        <input class="form-control" type="hidden" name="id" value="{{$member->id}}">
                        <div class="mb-3" style="margin-top: 32px;">
                            <label>Top Up</label>
                            <input type="text" class="form-control" name="wallet" placeholder="Input Amount">
                        </div>

                        <div class="d-grid gap-2" style="margin-top: 32px;">
                            <button type="submit" style="background-color: #4F7AF6;" class="btn btn-primary">Top Up</button>
                        </div>
                    </form>

                </div>
                <!-- end Money -->

            </div>
        </div>

    </section>

    <footer class="footer">
        @include('main.member.templates.member-footer')

        @include('main.member.templates.member-basefoot')
    </footer>
</body>

</html>