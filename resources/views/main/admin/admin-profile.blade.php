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

            <div class="row">

                <!-- Breadcrumb -->
                <div class="row my-4">
                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Admin Profile</li>
                        </ol>
                    </nav>
                </div>
                <!-- end breadcrumb -->

                <!-- address information section -->
                <div class="col" style="border-color: gainsboro; border-style: solid; border-width: 2px; border-radius: 10px; padding: 20px; margin: 10px;">
                    <h5 class="text-start">Information Profile</h5>

                    <!--Form Line 1-->
                    <form action="{{ route('admin.profile.update')}}" enctype="multipart/form-data" method="post">
                        {{csrf_field()}}
                        <input class="form-control" type="hidden" name="id" value="{{$admin->id}}">
                        <div class="mt-4">
                            <img src="{{ asset($admin->image_url) }}" class="card-img-top" alt="..." style="width: 10rem;">
                            <input class="form-control form-control-lg" name="image_url" type="file">
                            @error('image_url')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            <p>Curent image : {{ $admin->image_name}}</p>
                        </div>

                        <h6 style="margin-top: 32px;">Username</h6>
                        <div class="">
                            <input type="text" class="form-control" value="{{ $admin->username}}" name="username">
                        </div>

                        <h6 style="margin-top: 32px;">Fullname</h6>
                        <div class="">
                            <input type="text" class="form-control" value="{{ $admin->User->name}}" name="name">
                        </div>

                        <h6 style="margin-top: 32px;">Email</h6>
                        <div class="">
                            <input type="text" class="form-control" value="{{ $admin->User->email}}" name="email">
                        </div>

                        <h6 style="margin-top: 32px;"></h6>Phone</h6>
                        <div class="">
                            <input type="text" class="form-control" value="{{ $admin->no_hp}}" name="no_hp">
                        </div>

                        <div class="d-grid gap-2" style="margin-top: 32px;">
                            <button type="submit" style="background-color: #4F7AF6;" class="btn btn-primary">Update Profile</button>
                        </div>
                    </form>

                    <!--End Form Line 1-->

                </div>

            </div>
        </div>

    </section>

    <footer class="footer">
        @include('main.admin.templates.admin-footer')

        @include('main.admin.templates.admin-basefoot')
    </footer>
</body>

</html>