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
                        <li class="breadcrumb-item active" aria-current="page">User</li>
                    </ol>
                </nav>
            </div>
            <!-- end breadcrumb -->

            <!-- search -->
            <div class="row mt-4">
                <div class="input-group mb-3">
                    <form class="d-flex mt-4" action="{{ route('admin.member.search')}}" method="GET">
                        <input type="text" class="form-control" placeholder="Search User" name="search" />
                        <button class="btn btn-primary ms-3" style="background-color: #4F7AF6;" type="submit">
                            Search
                        </button>
                    </form>
                </div>
            </div>
            <!-- end search -->

            <div class="row mt-2 mx-1" style="border-radius: 6px; border-style: solid; border-width: 2px; border-color: #E0E0E0;">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name User</th>
                            <th scope="col">Email</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($member->isNotEmpty())

                        @foreach($member as $memberList)
                        <!-- card 1 -->
                        <tr class="align-middle">
                            <th scope="row">-</th>
                            <td>{{$memberList->username}}</td>
                            <td>{{$memberList->User->email}}</td>
                            @if ($memberList->status == 'Active')
                            <td><span class="badge text-bg-success">{{$memberList->status}}</span></td>
                            @else
                            <td><span class="badge text-bg-danger">{{$memberList->status}}</span></td>
                            @endif
                            <td class="text-center">
                                <a type="button" href="{{ route('admin.member.profile', ['id' => $memberList->id]) }}" class="btn btn-primary">See Detail</a>
                                @if ($memberList->status == 'Active')
                                <a type="button" class="btn btn-danger" href="{{ route('admin.member.set-status', ['id' => $memberList->id]) }}" onclick="return confirm('sure?');">Disable</a>
                                @else
                                <a type="button" class="btn btn-success" href="{{ route('admin.member.set-status', ['id' => $memberList->id]) }}" onclick="return confirm('sure?');">Enable</a>
                                @endif
                            </td>
                        </tr>
                        <!-- end card 1 -->
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

            {{ $member->appends(request()->input())->links()}}

        </div>

    </section>
    @include('main.admin.modal.admin-modal-transaction-history')

    <footer class="footer">
        @include('main.admin.templates.admin-footer')

        @include('main.admin.templates.admin-basefoot')
    </footer>
</body>

</html>