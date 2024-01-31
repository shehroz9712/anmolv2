@extends('Dashboard.Master.master_layout')

@section('title')
    EatAnmol - Menu
@endsection
@section('content')
    <div class="main-container container-fluid">
        <div class="inner-body">

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Menu - Pre Packages </h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Menu - Pre Packages</li>
                    </ol>
                </div>

            </div>
            <!-- End Page Header -->



            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card custom-card mg-b-20">
                        <div class="card-body">
                            <div class="main-content-label mg-b-5">
                                Select Package
                            </div>
                            <p class="text-muted card-sub-title">All packages contains awesome options of food for your
                                event.</p>
                            <div class="row">
                                <!-- col -->
                                @foreach ($categories as $key => $category)
                                    <div class="col-lg-4">
                                        <div class="col-lg-12">
                                            <i class="fa fa-snowflake"> </i>
                                            <h3>{{ $category->name }}</h3>
                                            <p>Package Overview or Deatils</p>
                                        </div>
                                        <ul id="treeview{{ $key + 1 }}">
                                            @foreach ($category->packages as $item)
                                                <li><a href="#">$ {{ $item->price }}</a>
                                                    <ul>
                                                        @foreach ($item->include as $include)
                                                            <li>{{ $include->qty }} - {{ $include->sharable->name }}</li>
                                                        @endforeach

                                                        <li><a href="#"><button
                                                                    class="btn ripple btn-outline-primary col-md-12"
                                                                    style="padding: 5px; ">Select Food Items</button></a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            @endforeach

                                        </ul>
                                    </div>
                                    <!-- /col -->
                                @endforeach


                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- /row -->

        </div>
    </div>
@endsection
@section('js')
@endsection
