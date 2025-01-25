@extends('Dashboard.Master.master_layout')

@section('title')
    Addon Menu - EatAnmol
@endsection
@section('stylesheet')
@endsection


@section('content')
    <div class="main-container container-fluid">
        <div class="inner-body">


            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Menu Items </h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="https://anmolv2.jmahalal.com/dashboard">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="https://anmolv2.jmahalal.com/events">Events</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Menu Items</li>
                    </ol>
                </div>
            </div>
            <!-- End Page Header -->
            <!-- row -->
            <div class="card custom-card mg-b-20">
                <div class="card-body">
                    <form action="{{ route('menu.submit') }}" id="menuForm" method="POST">
                        @csrf
                        <input type="hidden" name="url" value="items">
                        <input type="hidden" name="eventId" value="{{ $eventId }}">
                        <div class="row">
                            @foreach ($courseTypes as $courseType)
                                <div class="col-md-4">
                                    <div class="card custom-card mg-b-20">
                                        <div class="card-body">
                                            <div class="main-content-label mg-b-5">{{ $courseType->type }}</div>
                                            <p class="text-muted card-sub-title">
                                                Select Food Items as per Category and Service Style
                                            </p>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <ul id="treeview{{ $courseType->id }}">
                                                        @forelse ($courseType->serviceStyles as $serviceStyle)
                                                            <li>
                                                                <a href="#">{{ $serviceStyle->name }}</a>
                                                                <ul>
                                                                    @forelse ($serviceStyle->subCategories as $subCategory)
                                                                        <li>
                                                                            {{ $subCategory->name }}
                                                                            <ul>
                                                                                @forelse ($subCategory->dishes as $dish)
                                                                                    <li class="align-items-end row">
                                                                                        <div class="col-lg-10"
                                                                                            style="padding-right:0px !important;">
                                                                                            <input type="checkbox"
                                                                                                class="checkbox dish-checkbox selected_dish"
                                                                                                name="dishid[]"
                                                                                                value="{{ $dish->id }}|{{ $dish->price ?? 0 }}"
                                                                                                data-subcategory-id="{{ $subCategory->id }}"
                                                                                                data-single-price="{{ $subCategory->single }}"
                                                                                                data-double-price="{{ $subCategory->double }}"
                                                                                                data-trio-price="{{ $subCategory->trio }}">
                                                                                            {{ $dish->name }}
                                                                                        </div>

                                                                                        <div class="col-lg-2">

                                                                                            <a class="btn ripple float"
                                                                                                data-bs-target="#modaldemo{{ $dish->id }}"
                                                                                                data-bs-toggle="modal"
                                                                                                href="">
                                                                                                <i class="fa fa-info-circle"
                                                                                                    style="font-size: 12px;"></i>
                                                                                            </a>


                                                                                            <div class="modal fade"
                                                                                                id="modaldemo{{ $dish->id }}"
                                                                                                tabindex="-1"
                                                                                                role="dialog"
                                                                                                aria-labelledby="exampleModalLabel"
                                                                                                aria-hidden="true">
                                                                                                <div class="modal-dialog"
                                                                                                    role="document">
                                                                                                    <div
                                                                                                        class="modal-content">
                                                                                                        <div
                                                                                                            class="modal-header">
                                                                                                            <h5 class="modal-title"
                                                                                                                id="exampleModalLabel">
                                                                                                                {{ $dish->name }}
                                                                                                            </h5>
                                                                                                            <button
                                                                                                                type="button"
                                                                                                                class="btn-close"
                                                                                                                data-bs-dismiss="modal"
                                                                                                                style="margin: -10px 0 0px 0px;"
                                                                                                                aria-label="Close">
                                                                                                                <i
                                                                                                                    class="fa fa-close fs-5"></i>
                                                                                                            </button>
                                                                                                        </div>
                                                                                                        @php
                                                                                                            $image = $dish->image
                                                                                                                ? $dish->image
                                                                                                                : 'no-image.png';
                                                                                                        @endphp
                                                                                                        <div
                                                                                                            class="modal-body text-justify">
                                                                                                            <img src="{{ asset('uploads/dishes/' . ($dish->image ?? 'no-image.png')) }}"
                                                                                                                alt="image">
                                                                                                            <p>{!! $dish->long_desc !!}
                                                                                                            </p>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </li>
                                                                                @empty
                                                                                    <li>Not Found</li>
                                                                                @endforelse
                                                                            </ul>
                                                                        </li>
                                                                    @empty
                                                                        <li>Not Found</li>
                                                                    @endforelse
                                                                </ul>
                                                            </li>
                                                        @empty
                                                            <li>Not Found</li>
                                                        @endforelse
                                                    </ul>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <button type="submit" id="saveButton"
                            class="btn ripple btn-primary col-md-3 float-right">Submit</button>
                    </form>

                </div>

            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        var form = document.getElementById('menuForm');
        var saveButton = document.getElementById('saveButton');

        saveButton.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default form submission
            Swal.fire({
                title: 'Would you like to add more items to your menu as addons?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form with additional data indicating the choice
                    submitForm(true);
                } else {
                    // Continue with form submission without navigating
                    submitForm(false);
                }
            });
        });

        function submitForm(navigateToAddon) {
            // Append a hidden input to the form to indicate the user's choice
            var navigateInput = document.createElement('input');
            navigateInput.type = 'hidden';
            navigateInput.name = 'navigate_to_addon';
            navigateInput.value = navigateToAddon ? 'yes' : 'no';
            form.appendChild(navigateInput);

            // Submit the form
            form.submit();
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const checkboxes = document.querySelectorAll('.dish-checkbox');
            const subcategoryPrices = {};

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', () => {
                    const subcategoryId = checkbox.getAttribute('data-subcategory-id');
                    const singlePrice = parseFloat(checkbox.getAttribute('data-single-price')) || 0;
                    const doublePrice = parseFloat(checkbox.getAttribute('data-double-price')) || 0;
                    const trioPrice = parseFloat(checkbox.getAttribute('data-trio-price')) || 0;

                    // Find all checkboxes within the same subcategory
                    const subcategoryCheckboxes = document.querySelectorAll(
                        `.dish-checkbox[data-subcategory-id="${subcategoryId}"]`
                    );

                    // Count selected dishes in the subcategory
                    const selectedDishes = Array.from(subcategoryCheckboxes).filter(cb => cb
                        .checked).length;

                    // Calculate the price based on selected dishes
                    let subcategoryPrice = 0;
                    if (selectedDishes === 1) {
                        subcategoryPrice = singlePrice;
                    } else if (selectedDishes === 2) {
                        subcategoryPrice = doublePrice;
                    } else if (selectedDishes >= 3) {
                        subcategoryPrice = trioPrice;
                    }

                    // Update the subcategory price
                    subcategoryPrices[subcategoryId] = subcategoryPrice;

                    // Update all checkboxes in the subcategory with the calculated price
                    subcategoryCheckboxes.forEach(cb => {
                        const [id, _] = cb.value.split(
                            '|'); // Extract dish id and ignore existing price
                        cb.value = `${id}|${subcategoryPrice}`;
                    });

                    // Log for debugging
                    console.log(
                        `Subcategory ID: ${subcategoryId}, Total Price: ${subcategoryPrice}`);
                });
            });
        });
    </script>
@endsection
