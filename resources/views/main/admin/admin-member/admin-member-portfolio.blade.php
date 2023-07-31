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
                        <li class="breadcrumb-item"><a href="{{ route('admin.member') }}">Member</a></li>
                        <li class=" breadcrumb-item active" aria-current="page">{{$member->username}}</li>
                    </ol>
                </nav>
            </div>
            <!-- end breadcrumb -->

            <div class="row mt-4">
                <div class="col-3">
                    <div class="card mt-3">
                        <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                            <a href="{{ route('admin.member.profile', ['id' => $member->id]) }}" class="btn btn-light" role="button">User Profile</a>
                            <button class="btn btn-primary" disabled>Portfolio</button>
                            <a href="adminUserHistoryTransactionPage.html" class="btn btn-light" role="button">History
                                Transaction</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="row">
                        <div class="row">
                            <div class="col mt-4" style="border-color: #E0E0E0; border-style: solid; border-width: 2px; border-radius: 10px; padding: 20px; margin-top: 10px;">

                                <div style="display: flex; justify-content: space-between;">
                                    <h5 class="text-start">Designed already publish in public</h5>
                                    <div style="display: flex;">
                                        <div class="date-section align-items-center" style="display: col;">
                                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#dateModalMemberPortfolio"><i class="fa-regular fa-calendar me-2"></i>{{$dateFilter}}
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                @if($posting->isNotEmpty())

                                @foreach($posting as $postingList)
                                <!-- card 1 -->
                                <div class="card mt-3" style="flex-direction: row; padding: 20px;">
                                    <a href="{{ route('admin.detail-design', ['id' => $postingList->id]) }}">
                                        <img src="{{ asset($postingList->image_url) }}" class="card-img-top align-self-start" alt="..." style="width: 10rem;">
                                    </a>
                                    <div class="card-body">
                                        <div class="text-section">
                                            <h5 class="card-title fw-bold">{{$postingList->title}}</h5>
                                            <p class="card-text">Upload on <strong> {{$postingList->created_at}} </strong></p>
                                            <p class="card-text">Buyer <strong> {{$postingList->download}} </strong></p>
                                            <p class="card-text">Income earned <strong> Rp {{$postingList->formattedIncome}} </strong></p>
                                            <p class="card-text">Design Price <strong> Rp {{$postingList->formattedPrice}} </strong></p>
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
                        </div>
                        <!-- end uploaded history section -->
                    </div>
                </div>
            </div>
            {{ $posting->appends(request()->input())->links()}}

        </div>

    </section>
    @include('main.admin.modal.admin-modal-member-portfolio')

    <footer class="footer">
        @include('main.admin.templates.admin-footer')

        @include('main.admin.templates.admin-basefoot')
    </footer>
</body>

</html>