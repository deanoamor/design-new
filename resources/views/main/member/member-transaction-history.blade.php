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
                        <li class="breadcrumb-item active" aria-current="page">History Transaction</li>
                    </ol>
                </nav>
            </div>
            <!-- end breadcrumb -->


            <!--Content-->
            <div class="container">

                <div class="row">
                    <h5 class="text-start" style="margin-top: 32px;">History Transaction</h5>

                    @if($transactionHistory->isNotEmpty())

                    @foreach($transactionHistory as $transaction)

                    <!-- card 1 -->
                    <div class="card mt-3" style="padding: 10px;">
                        <div class="row">
                            <div class="col">
                                <img src="{{ asset($transaction->Copy_posting->image_url) }}" class="card-img-top" alt="..." style="width:150px;height:150px;">
                            </div>
                            <div class="col">
                                <h6>{{$transaction->Copy_posting->title}}</h6>
                                <p style="color: gray;">{{$transaction->created_at}}</p>
                                <p>{{$transaction->Copy_posting->price}}</p>
                                <span class="badge text-bg-success">{{$transaction->status}}</span>

                            </div>

                            <div class="col">
                                <a href="{{ route('member.transaction-history.download', ['id' => $transaction->Copy_posting->id]) }} " type="button" class="btn btn-link" style="color: blue;">Download</a>
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
        </div>
        </div>

    </section>

    <footer class="footer">
        @include('main.member.templates.member-footer')

        @include('main.member.templates.member-basefoot')
    </footer>
</body>

</html>