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

            <div class="row mt-4">
                <div class="col">
                    <a href="{{ route('admin.member') }}">
                        <div class="card mt-3" style="padding: 20px;">
                            <p>Total Member</p>
                            <h4>{{$memberCount}}</h4>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="{{ route('admin.uploaded-history') }}">
                        <div class="card mt-3" style="padding: 20px;">
                            <p>Total Design Uploaded</p>
                            <h4>{{$postingCount}}</h4>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="{{ route('admin.transaction-history') }}">
                        <div class="card mt-3" style="padding: 20px;">
                            <p>Total Design Purchased</p>
                            <h4>{{$transactionCount}}</h4>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <div class="card mt-3" style="padding: 20px;">
                        <p>Total Income</p>
                        <h4>Rp {{$admin->formattedWallet}}</h4>
                    </div>
                </div>
            </div>

            <div class="row mt-5 mx-1" style="border-radius: 6px; border-style: solid; border-width: 2px; border-color: #E0E0E0;">
                <h5>Report</h5>
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name User</th>
                            <th scope="col">Email</th>
                            <th scope="col">Date</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($report->isNotEmpty())

                        @foreach($report as $reportMember)
                        <tr class="align-middle">
                            <th scope="row">-</th>
                            <td>{{$reportMember->Member->username}}</td>
                            <td>{{$reportMember->Member->User->email}}</td>
                            <td>{{$reportMember->created_at}}</td>
                            <td class="text-center">
                                <button type="button" data-bs-toggle="modal" data-bs-target="#reportModalAdmin{{$reportMember->id}}" class="btn btn-primary">See Report</button>
                                <a type="button" onclick="return confirm('sure?');" href="{{ route('admin.home.report.delete', ['id' => $reportMember->id]) }}" class="btn btn-danger">Make Done</a>
                            </td>
                        </tr>
                        @include('main.admin.modal.admin-modal-report')
                        @endforeach

                        @else
                        <div class="col-12 mt-4">
                            <div class="alert alert-danger justify-content-between" role="alert">
                                <h4 class="alert-heading basefont">Data Not Available</h4>
                            </div>
                        </div>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

    </section>

    <footer class="footer">
        @include('main.admin.templates.admin-footer')

        @include('main.admin.templates.admin-basefoot')
    </footer>
</body>

</html>