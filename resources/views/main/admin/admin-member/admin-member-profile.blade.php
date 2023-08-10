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
                        <li class="breadcrumb-item active" aria-current="page">{{$member->username}}</li>
                    </ol>
                </nav>
            </div>
            <!-- end breadcrumb -->

            <div class="row mt-4">
                <div class="col-3">
                    <div class="card mt-3">
                        <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                            <button href="adminUserDetailPage.html" class="btn btn-primary" disabled>User Profile</button>
                            <a href="{{ route('admin.member.portfolio', ['id' => $member->id]) }}" class="btn btn-light" role="button">Portfolio</a>
                            <a href="{{ route('admin.member.transaction-history', ['id' => $member->id]) }}" class="btn btn-light" role="button">History
                                Transaction</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="row">
                        <div class="row">
                            <div class="col">
                                <div class="card mt-3" style="padding: 20px;">
                                    <p>Total Contribution Design</p>
                                    <h4>{{$postingCount}}</h4>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card mt-3" style="padding: 20px;">
                                    <p>Total Purchase Design</p>
                                    <h4>{{$transactionHistoryCount}}</h4>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card mt-3" style="padding: 20px;">
                                    <p>Total User Money</p>
                                    <h4>Rp {{$member->formattedWallet}}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="card mt-3" style="flex-direction: row; padding: 20px;">
                                    <img src="{{ asset($member->image_url) }}" class="card-img-top rounded-circle align-self-start" alt="..." style="width: 150px; height:150px">
                                    <div class="card-body">
                                        <div class="text-section">
                                            <div class="username">
                                                <p class="username-font" style="font-size: 16px;">Username</p>
                                                <h5 class="card-title fw-bold">{{$member->username}}</h5>
                                            </div>
                                            <div class="fullname mt-5">
                                                <p class="username-font" style="font-size: 16px;">Fullname</p>
                                                <h5 class="card-title fw-bold">{{$member->User->name}}</h5>
                                            </div>
                                            <div class="email mt-5">
                                                <p class="username-font" style="font-size: 16px;">Email</p>
                                                <h5 class="card-title fw-bold">{{$member->User->email}}</h5>
                                            </div>
                                            <div class="username mt-5">
                                                <p class="username-font" style="font-size: 16px;">Join Date</p>
                                                <h5 class="card-title fw-bold">{{$member->created_at}}</h5>
                                            </div>
                                            <div class="status mt-5">
                                                <p class="username-font" style="font-size: 16px;">Status</p>
                                                @if ($member->status == 'Active')
                                                <td><span class="badge text-bg-success">{{$member->status}}</span></td>
                                                @else
                                                <td><span class="badge text-bg-danger">{{$member->status}}</span></td>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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