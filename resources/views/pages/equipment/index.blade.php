@extends('Dashboard.Master.master_layout')
@section('title')
    Equipments list - EatAnmol
@endsection
@section('content')
    <div class="inner-body">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5"></h2>
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Equipment List</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('events.index') }}">Events</a></li>
                        <li class="breadcrumb-item active" aria-current="page">List Equipment</li>
                    </ol>
                </div>
            </div>

        </div>
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card custom-card mg-b-20">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="example2">
                                <thead>
                                    <tr>
                                        <th>No of Guest.</th>
                                        <th>Food</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dish as $item)
                                        <tr>
                                            <td>{{ $event->guests }}</td>
                                            <td>
                                                {{ optional($item->dishes)->name }}<br>
                                                @php

                                                    $price = 0;
                                                @endphp
                                                @if (empty($item->dishes->equipment))
                                                    <small>No equipment found</small>
                                                @else
                                                    @foreach ($item->dishes->equipment as $equipment)
                                                        @php
                                                            $price += $equipment->price;
                                                        @endphp
                                                        <small class="ms-3">{{ $equipment->name }}</small><br>
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>$ {{ number_format(round($price, 2), 2, '.', ',') }}</td>
                                            <td>$ {{ number_format(round($price * $event->guests, 2), 2, '.', ',') }}</td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('js')
    @endsection
