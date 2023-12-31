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
            <!-- Breadcrumb -->
            <div class="row my-4">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Uploaded History Page</li>
                    </ol>
                </nav>
            </div>
            <!-- end breadcrumb -->

            <!-- uploaded history section -->
            <div class="col" style="border-color: #E0E0E0; border-style: solid; border-width: 2px; border-radius: 10px; padding: 20px; margin-top: 10px;">

                <div style="display: flex; justify-content: space-between;">
                    <h5 class="text-start">Uploaded History</h5>
                    <div class="date-section align-items-center" style="display: col;">
                        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#dateModalUploadedHistory"><i class="fa-regular fa-calendar me-2"></i>{{$dateFilter}}
                        </button>
                    </div>
                </div>

                @if($posting->isNotEmpty())

                @foreach($posting as $uploadedHistory)
                <!-- card 1 -->
                <div class="card mt-3" style="flex-direction: row; padding: 20px;">
                    <a href="{{ route('admin.detail-design', ['id' => $uploadedHistory->id]) }}">
                        <img src="{{ asset($uploadedHistory->image_url) }}" class="card-img-top" alt="..." style="width:150px;height:150px;">
                    </a>
                    <div class="card-body">
                        <div class="text-section">
                            <h5 class="card-title fw-bold">{{$uploadedHistory->title}}</h5>
                            <p class="card-text">By {{$uploadedHistory->Member->username}}</p>
                            <p class="card-text">Uploaded at {{$uploadedHistory->created_at}}</p>
                            <h5 class="mt-3">Rp {{$uploadedHistory->formattedPrice}}</h5>
                        </div>
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
            {{ $posting->appends(request()->input())->links()}}

        </div>

    </section>
    @include('main.admin.modal.admin-modal-uploaded-history')

    <footer class="footer">
        @include('main.admin.templates.admin-footer')

        @include('main.admin.templates.admin-basefoot')
    </footer>
</body>

</html>