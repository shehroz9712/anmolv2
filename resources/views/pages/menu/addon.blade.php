@extends('Dashboard.Master.master_layout')

@section('title')
    EatAnmol - Menu
@endsection
@section('stylesheet')
    <style>
        .ckbox span:hover {
            cursor: pointer;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('content')
    <div class="main-container container-fluid">
        <div class="inner-body">
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Menu </h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Menu</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card custom-card mg-b-20">
                        <div class="card-body">
                            <div class="row">
                                <!-- col -->
                                @foreach ($categories as $key => $category)
                                    <div class="col-lg-12">
                                        <h3>{{ $category->name }}</h3>
                                        <p>Subcategory Overview or Details</p>
                                        <ul id="treeview{{ $key + 1 }}">
                                            <!-- Loop through sub-categories -->
                                            @foreach ($category->sub_category as $sub_category)
                                                <li>
                                                    <a href="#">
                                                        {{ $sub_category->name }}
                                                    </a>
                                                    <ul>
                                                        <!-- Loop through dishes -->
                                                        @foreach ($sub_category->dishes ?? [] as $key => $dishes)
                                                            <li>
                                                                <div class="form-group mg-b-20">
                                                                    <div class="align-items-center row">
                                                                        <div class="col-md-10">
                                                                            <label class="ckbox">
                                                                                <input type="checkbox" class="dish-checkbox"
                                                                                    data-category="{{ $sub_category->name }}"
                                                                                    data-id="{{ $dishes->id }}">
                                                                                <span
                                                                                    class="tx-13">{{ $dishes->name }}</span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-md-2">
                                                                            <a class="btn ripple"
                                                                                data-bs-target="#modaldemo{{ $dishes->id }}"
                                                                                data-bs-toggle="modal" href="#">
                                                                                <i class="fa fa-search"
                                                                                    style="font-size: 12px;"></i>
                                                                            </a>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <p>{{ $dishes->desc }}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal fade" id="modaldemo{{ $dishes->id }}"
                                                                    tabindex="-1" role="dialog"
                                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="exampleModalLabel">
                                                                                    {{ $dishes->name }}</h5>
                                                                                <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    style="margin: -10px 0 0px 0px;"
                                                                                    aria-label="Close">
                                                                                    <i class="fa fa-close fs-5"></i>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <p>{!! $dishes->long_desc !!}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endforeach
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
                <div class="col-lg-6">
                    <div class="card custom-card">
                        <div class="card-header">
                            <h5 class="mb-3 font-weight-bold tx-14">Selected Menu</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('menu.submit') }}" method="post">
                                @csrf


                                <input type="hidden" name="url" value="{{ Request::segments()[1] }}">
                                <div class="table-responsive">
                                    <table class="table border table-hover text-nowrap table-shopping-cart mb-0"
                                        id="selected-dishes">
                                        <thead class="text-muted">
                                            <tr class="small text-uppercase">
                                                <th scope="col">Items</th>
                                            </tr>
                                        </thead>
                                        <tbody>



                                        </tbody>

                                    </table>
                                    <div id="single-category-dishes-count"></div>
                                    <button class="btn ripple btn-outline-primary" id="save-button"
                                        style="padding: 5px; margin: 12px 0px; float:right; text-align-last: true; display:none">Save
                                        &
                                        Continue</button>
                                    <button class="btn ripple btn-outline-primary" id="skip-button"
                                        style="padding: 5px; margin: 12px 0px; float:right; text-align-last: true;">Skip &
                                        Continue</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
    </div>
@endsection
@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var checkboxes = document.querySelectorAll('.dish-checkbox');

            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    var selectedCheckboxes = document.querySelectorAll('.dish-checkbox:checked');
                    var category = checkbox.getAttribute('data-category');

                    // Check if the selected count exceeds the maximum allowed for the current category
                    var selectedCheckboxesForCategory = Array.from(selectedCheckboxes).filter(
                        function(checkbox) {
                            return checkbox.getAttribute('data-category') === category;
                        });

                    if (selectedCheckboxesForCategory.length > parseInt(checkbox.getAttribute(
                            'data-max'))) {
                        checkbox.checked = false;
                        // alert('You can only select up to ' + checkbox.getAttribute('data-max') +
                        //     ' items in ' + category + '.');
                        alert('if you want change the selected dish in ' + category +
                            ', kindly unselect the checked dish')
                    }
                });
            });
        });
    </script>

    <script>
        function limitWords(text, limit) {
            var words = text.split(' ');
            if (words.length > limit) {
                return words.slice(0, limit).join(' ') + '...';
            }
            return text;
        }

        document.addEventListener('DOMContentLoaded', function() {
            var checkboxes = document.querySelectorAll('.dish-checkbox');
            var tableContainer = document.querySelector('#selected-dishes');
            var saveButton = document.querySelector('#save-button');
            var skipButton = document.querySelector('#skip-button');

            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    var selectedCheckboxes = document.querySelectorAll('.dish-checkbox:checked');
                    var isEmpty = selectedCheckboxes.length === 0;

                    // Make an AJAX request to update the server with selected dishes data
                    updateSelectedDishes(selectedCheckboxes);
                });
            });

            function updateSelectedDishes(selectedCheckboxes) {
                var selectedDishesIds = Array.from(selectedCheckboxes).map(function(checkbox) {
                    return checkbox.getAttribute('data-id');
                });

                // Make an AJAX request to update the server with selected dishes data
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: "{{ route('menu.getDishes') }}",
                    data: {
                        id: selectedDishesIds
                    },
                    success: function(response) {
                        // Clear the existing table container content
                        tableContainer.innerHTML = '';

                        // Iterate over the response and append rows to the table
                        response.forEach(function(dish) {
                            var newRow = document.createElement('tr');
                            newRow.innerHTML = `
                        <td>
                            <div class="media">
                                <div class="media-body my-auto">
                                    <div class="card-item-desc mt-0">
                                        <h6 class="font-weight-semibold mt-0 text-uppercase">${dish.name}</h6>
                                        <dl class="card-item-desc-1">
                                            <dt>${dish.subcategory.name}</dt>
                                            <dd>Price: $${dish.final_price}</dd>
                                            <p>${dish.desc}</p>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </td>
                    `;

                            // Append the new row to the table container
                            tableContainer.appendChild(newRow);
                        });

                        // Show/hide buttons based on whether the table is empty or not
                        if (response.length === 0) {
                            skipButton.style.display = 'block';
                            saveButton.style.display = 'none';
                        } else {
                            skipButton.style.display = 'none';
                            saveButton.style.display = 'block';
                        }
                    },
                    error: function(response) {
                        // Handle errors if any
                    }
                });
            }
        });
    </script>
@endsection
