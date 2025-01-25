@extends('Dashboard.Master.master_layout')
@section('title')
    EatAnmol - Service Style Create
@endsection
@section('stylesheet')
    <style>
        /* Style the input */
        .custom-input {
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 10px;
            width: 100%;
            height: 36px;
            font-size: 14px;
        }

        .custom-addon {
            border: 1px solid #ccc;
            border-left: none;
            border-radius: 4px;
            padding-right: 10px;
            padding-left: 10px;
            /* height: 36px; */
            cursor: pointer;
        }

        .custom-addon i {
            color: #333;
        }

        #placeResults {
            position: absolute;
            width: 100%;
        }

        /* Tooltip container */
        .tooltip {
            position: relative;
            display: inline-block;
            border-bottom: 1px dotted black;
            /* If you want dots under the hoverable text */
        }

        /* Tooltip text */
        .tooltip .tooltiptext {
            visibility: hidden;
            width: 120px;
            background-color: black;
            color: #fff;
            text-align: center;
            padding: 5px 0;
            border-radius: 6px;

            /* Position the tooltip text - see examples below! */
            position: absolute;
            z-index: 1;
        }

        /* Show the tooltip text when you mouse over the tooltip container */
        .tooltip:hover .tooltiptext {
            visibility: visible;
        }

        .datepicker table tr td.disabled,
        .datepicker table tr td.disabled:hover {
            /* background-color: #ddd; */
            /* Grey background for disabled dates */
            color: #dcd3d3;
            /* Darker text color for disabled dates */
        }

        .description {
            margin-top: 20px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .draggable-list {
            list-style-type: none;
            padding: 0;
        }

        .draggable-list li {
            margin: 5px 0;
            padding: 10px;
            background: #fc9003;
            border: 1px solid #fc9003;
            cursor: move;
            color: white
        }

        .dragging {
            opacity: 0.5;
        }
    </style>
@endsection


@section('content')
    <div class="main-container container-fluid">
        <div class="inner-body">
            <div class="main-container container-fluid">
                <div class="inner-body">
                    <div class="page-header">
                        <div>
                            <h2 class="main-content-title tx-24 mg-b-5">Service Style</h2>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('events.index') }}">Events</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Service Style</li>
                            </ol>
                        </div>
                        <a href="{{ route('custom.menu', $eventId) }}">
                            <button class="btn ripple btn-primary col-md-12 float-left" style="padding: 5px; ">Pre
                                designed Packages</button>
                        </a>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card custom-card mg-b-20">
                                <div class="card-body">
                                    <div class="main-content-label mg-b-5"> Select Styles</div>
                                    <p class="text-muted card-sub-title">Now you can select multiple food service styles
                                        in every category </p>
                                    <form action="{{ route('service_style.submit') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <!-- col -->
                                            <input type="hidden" name="eventId" value="{{ $eventId }}">
                                            @foreach ($course_types as $course_type)
                                                <div class="col-lg-4">
                                                    <div class="col-lg-12">
                                                        <h3>{{ $course_type->type }}</h3>
                                                        <p>Package Overview or Deatils</p>
                                                    </div>
                                                    <ul id="treeview1" class="tree">
                                                        @foreach ($course_type->ServiceStyles as $service_style)
                                                            <li><input type="checkbox" class="checkbox me-2"
                                                                    name="{{ $course_type->id }}[]"
                                                                    value="{{ $service_style->id }}">
                                                                {{ $service_style->name }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endforeach


                                        </div>
                                        <button class="btn ripple btn-primary col-md-3 float-right" type="submit"
                                            style="padding: 5px; ">Select Items</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
