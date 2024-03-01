@extends('Dashboard.Master.master_layout')

@section('title')
    EatAnmol - Menu
@endsection
@section('stylesheet')
    <style>
        .ckbox span:hover {
            cursor: pointer;
        }

        dt {
            color: var(--primary-bg-color);
        }
    </style>
@endsection

@section('content')
    <div class="main-container container-fluid">
        <div class="inner-body">
            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Menu - Packages (${{ $package->price }})</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('index') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Menu</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">${{ $package->price }} Per Guest</li>
                    </ol>
                </div>
                <a href="{{ route('menu.index') }}"><button class="btn ripple btn-primary col-md-12"
                        style="padding: 5px; ">back to menu </button></a>
            </div>
            <!-- End Page Header -->
            <!-- row -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card custom-card mg-b-20">
                        <div class="card-body">
                            <div class="row">
                                <!-- col -->
                                <div class="col-lg-12">
                                    <h3>${{ $package->price }}</h3>
                                    <p>Package Overview or Deatils</p>
                                    <ul id="treeview1">

                                        @php
                                            $count = 0;
                                        @endphp

                                        @foreach ($package->include as $include)
                                            @php
                                                $count += $include->qty;
                                            @endphp
                                            <li>
                                                <a href="#">{{ $include->qty }} - {{ $include->sharable->name }}</a>
                                                <ul>
                                                    @if ($include->subcategory == null)
                                                        <li>
                                                            <div class="form-group mg-b-20 include-remaining">
                                                                <div class="align-items-center row">
                                                                    <div class="col-md-10">
                                                                        <label class="ckbox">
                                                                            <input type="checkbox" class="dish-checkbox "
                                                                                data-max="{{ $include->qty }}"
                                                                                data-category="{{ $include->sharable->name }}">
                                                                            <span
                                                                                class="tx-13">{{ $include->sharable->name }}</span>
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <a class="btn ripple"
                                                                            data-bs-target="#modaldemo{{ $loop->index + 1 }}"
                                                                            data-bs-toggle="modal" href="">
                                                                            <i class="fa fa-search"
                                                                                style="font-size: 12px;"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <p>{{ $include->sharable->desc }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal fade" id="modaldemo{{ $loop->index + 1 }}"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">
                                                                                {{ $include->sharable->name }}</h5>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                style="margin: -10px 0 0px 0px;"
                                                                                aria-label="Close"><i
                                                                                    class="fa fa-close fs-5"></i></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p>{!! $include->sharable->long_desc !!}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @else
                                                        @foreach ($include->subcategory->dishes ?? [] as $dishes)
                                                            <li>
                                                                <div class="form-group mg-b-20">
                                                                    <div class="align-items-center row">
                                                                        <div class="col-md-10">
                                                                            <label class="ckbox">
                                                                                <input type="checkbox" class="dish-checkbox"
                                                                                    data-max="{{ $include->qty }}"
                                                                                    data-category="{{ $include->sharable->name }}">
                                                                                <span
                                                                                    class="tx-13">{{ $dishes->name }}</span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-md-2">
                                                                            <a class="btn ripple"
                                                                                data-bs-target="#modaldemo{{ $loop->index + 1 }}"
                                                                                data-bs-toggle="modal" href="">
                                                                                <i class="fa fa-search"
                                                                                    style="font-size: 12px;"></i>
                                                                            </a>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <p>{{ $dishes->desc }}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal fade"
                                                                    id="modaldemo{{ $loop->index + 1 }}" tabindex="-1"
                                                                    role="dialog" aria-labelledby="exampleModalLabel"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="exampleModalLabel">
                                                                                    {{ $dishes->name }}</h5>
                                                                                <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    style="margin: -10px 0 0px 0px;"
                                                                                    aria-label="Close"><i
                                                                                        class="fa fa-close fs-5"></i></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <p>{!! $dishes->long_desc !!}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!-- /col -->

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
                            <form action="{{ route('menu.submit') }}" method="post" id="menuForm">
                                @csrf

                                <input type="hidden" name="url" value="package">

                                <input type="hidden" name="package" value="{{ Request::segments()[2] }}">

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

                                    <div id="dishes_no" class="my-2"x data-all="{{ $count }}">You have to
                                        select {{ $count }} dishes and remain {{ $count }} dishes</div>
                                    <button class="btn btn-outline-primary float-end ripple" id="saveButton"
                                        type="button" style="display: none"
                                        style="padding: 5px; margin: 12px 0px; float:right; text-align-last: true;">Save &
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
        document.addEventListener('DOMContentLoaded', function() {
            var checkboxes = document.querySelectorAll('.dish-checkbox');
            var saveButton = document.querySelector('#saveButton');
            var tableContainer = document.querySelector('#selected-dishes');
            var dishes_no = document.querySelector('#dishes_no');
            var count = parseInt(dishes_no.getAttribute('data-all'));
            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    var selectedCheckboxes = document.querySelectorAll('.dish-checkbox:checked');
                    var totalSelectedDishes = selectedCheckboxes.length;
                    var remainingDishes = Math.max(0, count - totalSelectedDishes);

                    // Update total selected dishes display
                    dishes_no.innerHTML = 'You have to select ' + totalSelectedDishes +
                        ' dishes and remain ' + remainingDishes + ' dishes';

                    // Show or hide save button based on the number of selected dishes
                    saveButton.style.display = totalSelectedDishes === count ? 'block' : 'none';

                    // Clear the existing table container content
                    tableContainer.innerHTML = '';

                    // Create a separate table for each category
                    var categoryTables = {};

                    // Iterate over selected checkboxes and add rows to the corresponding category table
                    selectedCheckboxes.forEach(function(selectedCheckbox) {
                        var category = selectedCheckbox.getAttribute('data-category');

                        // If the category table doesn't exist, create a new one
                        if (!categoryTables[category]) {
                            categoryTables[category] = document.createElement('table');
                            categoryTables[category].classList.add(
                                'your-table-class'); // Add your table class here

                            // Create a table body for the current category
                            var categoryTableBody = document.createElement('tbody');

                            // Append the table body to the current category table
                            categoryTables[category].appendChild(categoryTableBody);
                        }

                        var dishName = selectedCheckbox.closest('label').querySelector(
                            '.tx-13').textContent;
                        var dishDesc = selectedCheckbox.closest('li').querySelector('p')
                            .textContent;
                        var limitedDishDesc = limitWords(dishDesc, 10);

                        // Create a new table row
                        var newRow = document.createElement('tr');
                        newRow.innerHTML = `
                        <td>
                            <div class="media">
                                <div class="media-body my-auto">
                                    <div class="card-item-desc mt-0">
                                        <h6 class="font-weight-semibold mt-0 text-uppercase">${dishName}</h6>
                                        <dl class="card-item-desc-1">
                                            <dt>${category}</dt>
                                            <p>${limitedDishDesc}</p>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </td>
                    `;

                        // Append the new row to the current category table body
                        categoryTables[category].querySelector('tbody').appendChild(newRow);
                    });

                    // Append each category table to the table container
                    for (var category in categoryTables) {
                        if (categoryTables.hasOwnProperty(category)) {
                            tableContainer.appendChild(categoryTables[category]);
                        }
                    }
                });
            });

            // Function to limit words
            function limitWords(text, limit) {
                var words = text.split(' ');
                if (words.length > limit) {
                    return words.slice(0, limit).join(' ') + '...';
                }
                return text;
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('saveButton').addEventListener('click', function() {
                // Display SweetAlert confirmation dialog
                Swal.fire({
                    title: 'Are you sure?',
                    text: " If you select a package, you don't have to select individual custom items, except for addons.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, save it!',
                    cancelButtonText: 'No, cancel!'
                }).then((result) => {
                    // If user confirms, submit the form
                    if (result.isConfirmed) {
                        document.getElementById('menuForm').submit();
                    }
                });
            });
        });
    </script>
@endsection
