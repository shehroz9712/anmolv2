@extends('Dashboard.Master.master_layout')
@section('content')
    @if ($upcomingEvent)
        <!-- Main Content-->
        <div class="main-container container-fluid">
            <div class="inner-body">
                <!-- Page Header -->
                <div class="page-header">
                    <div>
                        <h2 class="main-content-title tx-24 mg-b-5">Welcome To Infoboard</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="javascript:void(0)">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Personal Infoboard</li>
                        </ol>
                    </div>
                    {{-- @if ($journey) --}}
                    <div class="justify-content-center">

                        <a href="{{ route('events.create') }}" class="btn btn-primary my-2 btn-icon-text">
                            <i class="fe fe-calendar me-2"></i> Create New Event
                        </a>
                    </div>
                    {{-- @endif --}}
                </div>
                <!-- End Page Header -->
                <!--Row-->
                <div class="row row-sm">
                    <div class="col-sm-12 col-lg-12 col-xl-8">
                        <!--Row-->
                        <div class="row row-sm">
                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                <div class="card custom-card">
                                    <div class="card-body">
                                        <div class="card-item">
                                            <div class="card-item-title mb-2">
                                                <label
                                                    class="main-content-label tx-13 font-weight-bold mb-1">{{ $upcomingEvent->name ?? '--' }}
                                                </label>
                                                <span
                                                    class="d-block tx-12 mb-0 text-muted">{{ $upcomingEvent->occasion ?? '--' }}</span>
                                            </div>
                                            <div class="card-item-body">
                                                <div class="card-item-stat">
                                                    @if ($upcomingEvent)
                                                        <h4 class="font-weight-bold">
                                                            {{ \Carbon\Carbon::parse($upcomingEvent->date)->format('m/d/Y') }}
                                                        </h4>
                                                    @else
                                                        <h4 class="font-weight-bold">---</h4>
                                                    @endif
                                                    <small>
                                                        <b class="text-success">{{ $upcomingEvent->start_time ?? '--' }} to
                                                            {{ $upcomingEvent->end_time ?? '--' }}</b>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                <div class="card custom-card">
                                    <div class="card-body">
                                        <div class="card-item">
                                            <div class="card-item-title mb-2">
                                                <label
                                                    class="main-content-label tx-13 font-weight-bold mb-1">{{ $venue->adminvenue->name ?? '--' }}</label>
                                            </div>
                                            <div class="card-item-food">
                                                <h6 class="d-block tx-12 mb-0 text-muted">Address</h6>
                                                <div class="card-item-stat">
                                                    <h6 class="font-weight-bold">{{ $venue->adminvenue->city ?? '---' }}
                                                    </h6>
                                                    <h6 class="font-weight-bold">{{ $venue->adminvenue->address ?? '---' }}
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-4">
                                <div class="card custom-card">
                                    <div class="card-body">
                                        <div class="card-item">
                                            <div class="card-item-title  mb-2">
                                                <label class="main-content-label tx-13 font-weight-bold mb-1">No Of Guest :
                                                    {{ $upcomingEvent->guests ?? '---' }}</label>
                                                <span class="d-block tx-12 mb-0 text-muted">Items: 12 {No of Selected
                                                    Items}</span>
                                            </div>
                                            <div class="card-item-body">
                                                <div class="card-item-stat">
                                                    <h4 class="font-weight-bold">$0,00 <small>{Invoice Amount}</small>
                                                    </h4>
                                                    <small>Remaining Amount: <b class="text-danger">$2,890</b>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End row-->
                        <!--row-->
                        <div class="row row-sm">
                            <div class="col-sm-12 col-lg-12 col-xl-12">
                                <div class="card custom-card overflow-hidden">

                                    <div class="card-body ps-0">
                                        <div class="row row-sm">
                                            <div class="col-lg-12">
                                                <div class="card custom-card p-3 mg-b-20">
                                                    <div class="card-header d-flex justify-content-between">
                                                        <h6><b>Events</b></h6>
                                                        <a href="{{ route('events.index') }}">Show all</a>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="table-responsive tasks">
                                                            <table
                                                                class="table card-table table-vcenter text-nowrap mb-0 border">
                                                                <thead>
                                                                    <tr>
                                                                        {{-- <th class="wd-lg-10p">ID</th> --}}
                                                                        <th class="wd-lg-20p">Name</th>
                                                                        <th class="wd-lg-20p">guests</th>
                                                                        <th class="wd-lg-10p">Date</th>
                                                                        <th class="wd-lg-10p">Type</th>
                                                                        {{-- <th class="wd-lg-10p">Occasion</th> --}}
                                                                        {{-- <th class="wd-lg-10p">Start Time</th>
                                                                        <th class="wd-lg-10p">End Time</th> --}}
                                                                        <th class="wd-lg-10p">Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($events as $event)
                                                                        <tr>
                                                                            {{-- <td>{{ $event->id }}</td> --}}
                                                                            <td>{{ $event->name }}</td>
                                                                            <td>{{ $event->guests }}</td>
                                                                            {{-- <td>{{ $event->date }}</td> --}}
                                                                            <td>{{ \Carbon\Carbon::parse($event->date)->format('m/d/Y') }}
                                                                            </td>
                                                                            <td>{{ $event->type }}</td>
                                                                            {{-- <td>{{ $event->occasion }}</td> --}}
                                                                            {{-- <td>{{ $event->start_time }}</td>
                                                                            <td>{{ $event->end_time }}</td> --}}
                                                                            <td class="d-flex">
                                                                                <form class="mx-1"
                                                                                    action="{{ route('continueJourney', ['eventId' => $event->id]) }}"
                                                                                    method="POST">
                                                                                    @csrf
                                                                                    <button type="submit"
                                                                                        class="btn btn-primary">
                                                                                        Continue Journey
                                                                                    </button>
                                                                                </form>

                                                                                {{-- <a class="btn text-dark px-1" href="{{ route('events.edit', ['encryptedId' => Crypt::encryptString($event->id)]) }}"><i class="fe fe-eye"></i></a> --}}



                                                                            </td>


                                                                            {{-- <div class="justify-content-center">

                                                                                <a href="{{ route('ContractIndex') }}" class="btn btn-primary my-2 btn-icon-text">
                                                                                    <i class="fe fe-calendar me-2"></i> Continue Journey
                                                                                </a>
                                                                            </div> --}}
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- col end -->
                            <div class="col-sm-12 col-lg-12 col-xl-6 mt-xl-6">
                                <div class="card custom-card card-dashboard-calendar pb-0">
                                    <label class="main-content-label mb-2 pt-1">Recent transcations</label>
                                    <span class="d-block tx-12 mb-2 text-muted">Projects where development work is on
                                        completion</span>
                                    <table class="table table-hover m-b-0 transcations mt-2">
                                        <tbody>
                                            <tr>
                                                <td class="wd-5p">
                                                    <div class="main-img-user avatar-md">
                                                        <img alt="avatar" class="rounded-circle me-3"
                                                            src="../assets/img/users/5.jpg">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-middle ms-3">
                                                        <div class="d-inline-block">
                                                            <h6 class="mb-1">Flicker</h6>
                                                            <p class="mb-0 tx-13 text-muted">App improvement</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-end">
                                                    <div class="d-inline-block">
                                                        <h6 class="mb-2 tx-15 font-weight-semibold">$45.234 <i
                                                                class="fas fa-level-up-alt ms-2 text-success m-l-10"></i>
                                                        </h6>
                                                        <p class="mb-0 tx-11 text-muted">12 Jan 2020</p>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="wd-5p">
                                                    <div class="main-img-user avatar-md">
                                                        <img alt="avatar" class="rounded-circle me-3"
                                                            src="../assets/img/users/6.jpg">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-middle ms-3">
                                                        <div class="d-inline-block">
                                                            <h6 class="mb-1">Intoxica</h6>
                                                            <p class="mb-0 tx-13 text-muted">Milestone</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-end">
                                                    <div class="d-inline-block">
                                                        <h6 class="mb-2 tx-15 font-weight-semibold">$23.452 <i
                                                                class="fas fa-level-down-alt ms-2 text-danger m-l-10"></i>
                                                        </h6>
                                                        <p class="mb-0 tx-11 text-muted">23 Jan 2020</p>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="wd-5p">
                                                    <div class="main-img-user avatar-md">
                                                        <img alt="avatar" class="rounded-circle me-3"
                                                            src="../assets/img/users/7.jpg">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-middle ms-3">
                                                        <div class="d-inline-block">
                                                            <h6 class="mb-1">Digiwatt</h6>
                                                            <p class="mb-0 tx-13 text-muted">Sales executive</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-end">
                                                    <div class="d-inline-block">
                                                        <h6 class="mb-2 tx-15 font-weight-semibold">$78.001 <i
                                                                class="fas fa-level-down-alt ms-2 text-danger m-l-10"></i>
                                                        </h6>
                                                        <p class="mb-0 tx-11 text-muted">4 Apr 2020</p>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="wd-5p">
                                                    <div class="main-img-user avatar-md">
                                                        <img alt="avatar" class="rounded-circle me-3"
                                                            src="../assets/img/users/8.jpg">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-middle ms-3">
                                                        <div class="d-inline-block">
                                                            <h6 class="mb-1">Flicker</h6>
                                                            <p class="mb-0 tx-13 text-muted">Milestone2</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-end">
                                                    <div class="d-inline-block">
                                                        <h6 class="mb-2 tx-15 font-weight-semibold">$37.285 <i
                                                                class="fas fa-level-up-alt ms-2 text-success m-l-10"></i>
                                                        </h6>
                                                        <p class="mb-0 tx-11 text-muted">4 Apr 2020</p>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="wd-5p pb-0">
                                                    <div class="main-img-user avatar-md">
                                                        <img alt="avatar" class="rounded-circle me-3"
                                                            src="../assets/img/users/4.jpg">
                                                    </div>
                                                </td>
                                                <td class="pb-0">
                                                    <div class="d-flex align-middle ms-3">
                                                        <div class="d-inline-block">
                                                            <h6 class="mb-1">Flicker</h6>
                                                            <p class="mb-0 tx-13 text-muted">App improvement</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-end pb-0">
                                                    <div class="d-inline-block">
                                                        <h6 class="mb-2 tx-15 font-weight-semibold">$25.341 <i
                                                                class="fas fa-level-down-alt ms-2 text-danger m-l-10"></i>
                                                        </h6>
                                                        <p class="mb-0 tx-11 text-muted">4 Apr 2020</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- col end -->
                            <!-- col end -->
                            <div class="col-sm-12 col-lg-12 col-xl-6 mt-xl-6">
                                <div class="card custom-card card-dashboard-calendar pb-0">
                                    <label class="main-content-label mb-2 pt-1">Recent Notification</label>
                                    <span class="d-block tx-12 mb-2 text-muted">Projects where development work is on
                                        completion</span>
                                    <table class="table table-hover m-b-0 transcations mt-2">
                                        <tbody>
                                            <tr>
                                                <td class="wd-5p">
                                                    <div class="main-img-user avatar-md">
                                                        <img alt="avatar" class="rounded-circle me-3"
                                                            src="../assets/img/users/5.jpg">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-middle ms-3">
                                                        <div class="d-inline-block">
                                                            <h6 class="mb-1">Flicker</h6>
                                                            <p class="mb-0 tx-13 text-muted">App improvement</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-end">
                                                    <div class="d-inline-block">
                                                        <h6 class="mb-2 tx-15 font-weight-semibold">$45.234 <i
                                                                class="fas fa-level-up-alt ms-2 text-success m-l-10"></i>
                                                        </h6>
                                                        <p class="mb-0 tx-11 text-muted">12 Jan 2020</p>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="wd-5p">
                                                    <div class="main-img-user avatar-md">
                                                        <img alt="avatar" class="rounded-circle me-3"
                                                            src="../assets/img/users/6.jpg">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-middle ms-3">
                                                        <div class="d-inline-block">
                                                            <h6 class="mb-1">Intoxica</h6>
                                                            <p class="mb-0 tx-13 text-muted">Milestone</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-end">
                                                    <div class="d-inline-block">
                                                        <h6 class="mb-2 tx-15 font-weight-semibold">$23.452 <i
                                                                class="fas fa-level-down-alt ms-2 text-danger m-l-10"></i>
                                                        </h6>
                                                        <p class="mb-0 tx-11 text-muted">23 Jan 2020</p>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="wd-5p">
                                                    <div class="main-img-user avatar-md">
                                                        <img alt="avatar" class="rounded-circle me-3"
                                                            src="../assets/img/users/7.jpg">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-middle ms-3">
                                                        <div class="d-inline-block">
                                                            <h6 class="mb-1">Digiwatt</h6>
                                                            <p class="mb-0 tx-13 text-muted">Sales executive</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-end">
                                                    <div class="d-inline-block">
                                                        <h6 class="mb-2 tx-15 font-weight-semibold">$78.001 <i
                                                                class="fas fa-level-down-alt ms-2 text-danger m-l-10"></i>
                                                        </h6>
                                                        <p class="mb-0 tx-11 text-muted">4 Apr 2020</p>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="wd-5p">
                                                    <div class="main-img-user avatar-md">
                                                        <img alt="avatar" class="rounded-circle me-3"
                                                            src="../assets/img/users/8.jpg">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-middle ms-3">
                                                        <div class="d-inline-block">
                                                            <h6 class="mb-1">Flicker</h6>
                                                            <p class="mb-0 tx-13 text-muted">Milestone2</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-end">
                                                    <div class="d-inline-block">
                                                        <h6 class="mb-2 tx-15 font-weight-semibold">$37.285 <i
                                                                class="fas fa-level-up-alt ms-2 text-success m-l-10"></i>
                                                        </h6>
                                                        <p class="mb-0 tx-11 text-muted">4 Apr 2020</p>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="wd-5p pb-0">
                                                    <div class="main-img-user avatar-md">
                                                        <img alt="avatar" class="rounded-circle me-3"
                                                            src="../assets/img/users/4.jpg">
                                                    </div>
                                                </td>
                                                <td class="pb-0">
                                                    <div class="d-flex align-middle ms-3">
                                                        <div class="d-inline-block">
                                                            <h6 class="mb-1">Flicker</h6>
                                                            <p class="mb-0 tx-13 text-muted">App improvement</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-end pb-0">
                                                    <div class="d-inline-block">
                                                        <h6 class="mb-2 tx-15 font-weight-semibold">$25.341 <i
                                                                class="fas fa-level-down-alt ms-2 text-danger m-l-10"></i>
                                                        </h6>
                                                        <p class="mb-0 tx-11 text-muted">4 Apr 2020</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- col end -->
                        </div>
                        <!-- Row end -->
                    </div>
                    <!-- col end -->
                    <div class="col-sm-12 col-lg-12 col-xl-4">
                        <div class="card custom-card">
                            <div class="card-header border-bottom-0 pb-0 d-flex ps-3 ms-1">
                                <div>
                                    <label class="main-content-label mb-2 pt-2">Event Manager</label>
                                </div>
                            </div>
                            <div class="card-body pt-2 mt-0">
                                <div class="list-card mb-0">
                                    <div class="d-flex">
                                        <div class="demo-avatar-group my-auto float-end">
                                            <div class="main-img-user avatar-md">
                                                <img alt="avatar" class="rounded-circle me-3"
                                                    src="../assets/img/users/4.jpg">
                                            </div>
                                            <div class="d-flex align-middle ms-3">
                                                <div class="d-inline-block">
                                                    <h6 class="mb-1">[Event Name]</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ms-auto float-end">
                                            <div class="">
                                                <a href="javascript:void(0)" class="option-dots"
                                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fe fe-more-horizontal"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-item mt-4">
                                        <div class="card-item-body">
                                            <div class="card-item-stat">
                                                <small class="tx-10 text-primary font-weight-semibold">Status: {Approve/
                                                    Pending/ Rejected}</small>
                                                <h6 class=" mt-2">[Manager Name]: Admin</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card custom-card">
                            <div class="card-header border-bottom-0 pb-0 d-flex ps-3 ms-1">
                                <div>
                                    <label class="main-content-label mb-2 pt-2">Documents</label>
                                </div>
                            </div>
                            <div class="card-body pt-2 mt-0">
                                <div class="list-card mb-0">
                                    <div class="d-flex">
                                        <div class="demo-avatar-group my-auto float-end">
                                            <div class="main-img-user avatar-xs">
                                                <i class="fa fa-file" style="color: #888; font-size: 18px"></i>
                                            </div>
                                            <div class=""> Agreement</div>
                                        </div>
                                        <div class="ms-auto float-end">
                                            <div class="">
                                                <a href="javascript:void(0)" class="option-dots"
                                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-download"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="demo-avatar-group my-auto float-end">
                                            <div class="main-img-user avatar-xs">
                                                <i class="fa fa-file" style="color: #888; font-size: 18px"></i>
                                            </div>
                                            <div class=""> Invoice</div>
                                        </div>
                                        <div class="ms-auto float-end">
                                            <div class="">
                                                <a href="javascript:void(0)" class="option-dots"
                                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-download"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- col end -->

                </div>
                <!-- Row end -->
            </div>
        </div>
        <!-- End Main Content-->
    @else
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">Welcome To Infoboard</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Personal Infoboard</li>
                </ol>
            </div>
        </div>
        <div class="d-flex">
            <div class="justify-content-center">

                <a href="{{ route('events.create') }}" class="btn btn-primary my-2 btn-icon-text">
                    <i class="fe fe-calendar me-2"></i> Add Event
                </a>
            </div>

        </div>
    @endif

@endsection
