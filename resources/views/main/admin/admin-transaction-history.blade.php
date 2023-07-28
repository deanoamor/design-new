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
                        <li class="breadcrumb-item active" aria-current="page">Transaction History Page</li>
                    </ol>
                </nav>
            </div>
            <!-- end breadcrumb -->

            <!-- uploaded history section -->
            <div class="col" style="border-color: #E0E0E0; border-style: solid; border-width: 2px; border-radius: 10px; padding: 20px; margin-top: 10px;">

                <div style="display: flex; justify-content: space-between;">
                    <h5 class="text-start">Transaction History</h5>
                    <div class="date-section align-items-center" style="display: col;">
                        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#dateModalTransactionHistory"><i class="fa-regular fa-calendar me-2"></i>{{$dateFilter}}
                        </button>
                    </div>
                </div>

                @if($transactionHistory->isNotEmpty())

                @foreach($transactionHistory as $transaction)
                <!-- card 1 -->
                <div class="card mt-3" style="flex-direction: row; padding: 20px;">
                    <img src="{{ asset($transaction->Copy_posting->image_url) }}" class="card-img-top" alt="..." style="width:150px;height:150px;">
                    <div class="card-body">
                        <div class="text-section">
                            <h5 class="card-title fw-bold">{{$transaction->Copy_posting->title}}</h5>
                            <p class="card-text">Buy By {{$transaction->Member->username}}</p>
                            <p class="card-text">Design by {{$transaction->Copy_posting->member_name}}</p>
                            <p class="card-text">Buy at {{$transaction->created_at}}</p>
                            <h5 class="mt-3">Total price RP {{$transaction->total}}</h5>
                            <h5 class="mt-3">Admin fee RP {{$transaction->admin_fee}}</h5>
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
            {{ $transactionHistory->appends(request()->input())->links()}}

        </div>

    </section>
    @include('main.admin.modal.admin-modal-transaction-history')

    <footer class="footer">
        @include('main.admin.templates.admin-footer')

        @include('main.admin.templates.admin-basefoot')
    </footer>
</body>

</html>