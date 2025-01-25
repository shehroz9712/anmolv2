@extends('Dashboard.Master.master_layout')

@section('title')
    Cart - EatAnmol
@endsection
@section('stylesheet')
@endsection


@section('content')
    <div class="main-container container-fluid">
        <div class="inner-body">

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Menu</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Events</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Selected Menu Items</li>
                    </ol>
                </div>
                {{-- <a href="">
                    <button class="btn ripple btn-primary col-md-12 float-left" style="padding: 5px; ">Add More
                        Items</button>
                </a> --}}
            </div>
            <!-- End Page Header -->

            <!-- Row -->
            <div class="row row-sm">
                <div class="col-lg-12 col-xl-9 col-md-12">
                    <div class="card custom-card">
                        <div class="card-header">
                            <h5 class="mb-3 font-weight-bold tx-14">Selected Menu</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table border table-hover text-nowrap table-shopping-cart mb-0">
                                    <thead class="text-muted">
                                        <tr class="small text-uppercase">
                                            <th scope="col"> Product</th>
                                            <th scope="col" class="wd-120">Price</th>
                                            <th scope="col" class="text-center ">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($menus as $menu)
                                            <tr>
                                                <td>
                                                    <div class="media">
                                                        <div class="card-aside-img">
                                                            <img src="{{ asset($menu->item->image ? 'uploads/dishes/' . $menu->item->image : 'uploads/dishes/no-image.png') }}"
                                                                alt="dish-image" class="img-sm">
                                                        </div>
                                                        <div class="media-body my-auto">
                                                            <h6 class="font-weight-semibold mt-0 text-uppercase">
                                                                {{ $menu->item->name }} </h6>
                                                            <dl class="card-item-desc-1">
                                                                <dt>{{ $menu->item->subcategory->name }} </dt>
                                                                <dd>{{ $menu->item->subcategory->serviceStyle->name }}</dd>
                                                            </dl>
                                                            <p></p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>${{ number_format($menu->item_price, 2) }}</td>

                                                <td class="text-center">
                                                    <a href="#" class="text-danger"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-xl-3 col-md-12">
                  

                    <div class="card custom-card cart-details">
                        <div class="card-body">
                            <h5 class="mb-3 font-weight-bold tx-14">PRICE DETAIL</h5>
                            @php
                                $totalPrice = $menus->sum('item_price'); // Total price of all items
                                $discount = 0; // Example discount value
                                $grandTotal = $totalPrice - $discount;
                            @endphp
                            <dl class="dlist-align">
                                <dt class="">ITEMS {{ count($menus) }}</dt>
                                <dd class="text-end ms-auto">${{ number_format($totalPrice, 2) }}</dd>
                            </dl>
                         
                           
                            <hr>
                            <dl class="dlist-align">
                                <dt>Total:</dt>
                                <dd class="text-end  ms-auto"><strong>${{ number_format($grandTotal, 2) }}</strong></dd>
                            </dl>
                            <div class="step-footer">
                                <a class="btn btn-success btn-block" href="#">Continue Shopping</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Row -->

        </div>
    </div>
@endsection
@section('js')
@endsection
