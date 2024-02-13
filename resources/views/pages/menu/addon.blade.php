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
@endsection

@section('content')
    <div class="main-container container-fluid">
        <div class="inner-body">
            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Menu </h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Menu</li>
                    </ol>
                </div>

            </div>
            <!-- End Page Header -->
            <!-- row -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card custom-card mg-b-20">
                        <div class="card-body">
                            <div class="row">
                                <!-- col -->
                                @foreach ($categories as $key => $category)
                                    <div class="col-lg-12">
                                        <h3>{{ $category->name }}</h3>
                                        <p>Package Overview or Deatils</p>
                                        <ul id="treeview{{ $key + 1 }}">
                                            @foreach ($category->sub_category as $package)
                                                <li>
                                                    <a href="#">
                                                        {{ $package->name }}</a>
                                                    <ul>

                                                        @foreach ($package->dishes ?? [] as $key => $dishes)
                                                            <li>
                                                                <div class="form-group mg-b-20">
                                                                    <div class="align-items-center row">
                                                                        <div class="col-md-10">
                                                                            <label class="ckbox">
                                                                                <input type="checkbox" class="dish-checkbox"
                                                                                    data-category="{{ $package->name }}">
                                                                                <span
                                                                                    class="tx-13">{{ $dishes->name }}</span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-md-2">
                                                                            <a class="btn ripple"
                                                                                data-bs-target="#modaldemo{{ $dishes->id }}"
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
                                                                                    aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <p>{!! $dishes->long_desc !!}</p>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-bs-dismiss="modal">Close</button>
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
                                <button class="btn ripple btn-outline-primary" id="save-button"
                                    style="padding: 5px; margin: 12px 0px; float:right; text-align-last: true; display:none">Save
                                    &
                                    Continue</button>
                                <button class="btn ripple btn-outline-primary" id="skip-button"
                                    style="padding: 5px; margin: 12px 0px; float:right; text-align-last: true;">Skip &
                                    Continue</button>
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

                    // Show/hide buttons based on whether the table is empty or not
                    if (isEmpty) {
                        skipButton.style.display = 'block';
                        saveButton.style.display = 'none';
                    } else {
                        skipButton.style.display = 'none';
                        saveButton.style.display = 'block';
                    }
                });
            });
        });
    </script>
@endsection
