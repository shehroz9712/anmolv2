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
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">Service Style</h2>
             <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('events.index') }}">Events</a></li>
                <li class="breadcrumb-item active" aria-current="page">Service Style</li>
            </ol>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-md-12">
            <div class="card custom-card">
                <div class="card-body">

                    <div class="row row-sm">
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="">
                                <form method="POST" action="{{ route('service.store') }}"  id="formid">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label class="form-label">Service Type</label>
                                            <select class="form-control" name="service_type" id="service_type" required>
                                                <option value="">Select Service Type</option>
                                                <option value="1">Buffet Style</option>
                                                <option value="2">Butler Style/Passed O’Dourves</option>
                                                <option value="3">Displayed Station/Buffet</option>
                                                <option value="4">Family Style</option>
                                                <option value="5">Platted/Course Meals</option>
                                                <option value="6">Action Station</option>
                                                <option value="7">Live Barbecue</option>
                                            </select>
                                            <div id="description" class="d-none description"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="fs-17 fw-bold ps-4">Appetizer</label>
                                        <div class="col-lg-6 form-group">
                                            <label for="start_time">Start Time</label>
                                            <div class="input-group " data-placement="bottom" data-align="top"
                                                data-autoclose="false" data-format="hh:mm">
                                                <input type="hidden" name="eventId" value="{{ $eventId }}">

                                                <input data-toggle="tooltip" data-placement="bottom" placeholder="06:00 PM"
                                                    title="Start Time" type="text" id="start_time"
                                                    name="appetizer_start_time" class="form-control  timePicker">
                                                <span class="input-group-addon custom-addon bg-primary">
                                                    <i class="fa fa-clock-o text-light" aria-hidden="true"
                                                        style="line-height: 36px;"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 form-group">
                                            <label for="end_time">End Time</label>
                                            <div class="input-group " data-placement="bottom" data-align="top"
                                                data-autoclose="false" data-format="hh:mm">
                                                <input data-toggle="tooltip" data-placement="bottom" placeholder="10:00 PM"
                                                    title="End Time" type="text" id="end_time" name="appetizer_end_time"
                                                    required class="form-control timePicker">
                                                <span class="input-group-addon custom-addon bg-primary">
                                                    <i class="fa fa-clock-o text-light" aria-hidden="true"
                                                        style="line-height: 36px;"></i>
                                                </span>
                                            </div>
                                        </div>

                                        <label class="fs-17 fw-bold ps-4">Main Course</label>
                                        <div class="col-lg-6 form-group">
                                            <label for="main_course_start_time">Start Time</label>
                                            <div class="input-group " data-placement="bottom" data-align="top"
                                                data-autoclose="false" data-format="hh:mm">
                                                <input data-toggle="tooltip" data-placement="bottom" placeholder="06:00 PM"
                                                    title="Start Time" type="text" id="main_course_start_time"
                                                    name="main_course_start_time" class="form-control  timePicker">
                                                <span class="input-group-addon custom-addon bg-primary">
                                                    <i class="fa fa-clock-o text-light" aria-hidden="true"
                                                        style="line-height: 36px;"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 form-group">
                                            <label for="main_course_end_time">End Time</label>
                                            <div class="input-group " data-placement="bottom" data-align="top"
                                                data-autoclose="false" data-format="hh:mm">
                                                <input data-toggle="tooltip" data-placement="bottom"
                                                    placeholder="10:00 PM" title="End Time" type="text"
                                                    id="main_course_end_time" name="main_course_end_time" required
                                                    class="form-control timePicker">
                                                <span class="input-group-addon custom-addon bg-primary">
                                                    <i class="fa fa-clock-o text-light" aria-hidden="true"
                                                        style="line-height: 36px;"></i>
                                                </span>
                                            </div>
                                        </div>

                                        <label class="fs-17 fw-bold ps-4">Dessert</label>
                                        <div class="col-lg-6 form-group">
                                            <label for="dessert_start_time">Start Time</label>
                                            <div class="input-group " data-placement="bottom" data-align="top"
                                                data-autoclose="false" data-format="hh:mm">
                                                <input data-toggle="tooltip" data-placement="bottom"
                                                    placeholder="06:00 PM" title="Start Time" type="text"
                                                    id="dessert_start_time" name="dessert_start_time"
                                                    class="form-control  timePicker">
                                                <span class="input-group-addon custom-addon bg-primary">
                                                    <i class="fa fa-clock-o text-light" aria-hidden="true"
                                                        style="line-height: 36px;"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 form-group">
                                            <label for="dessert_end_time">End Time</label>
                                            <div class="input-group " data-placement="bottom" data-align="top"
                                                data-autoclose="false" data-format="hh:mm">
                                                <input data-toggle="tooltip" data-placement="bottom"
                                                    placeholder="10:00 PM" title="End Time" type="text"
                                                    id="dessert_end_time" name="dessert_end_time" required
                                                    class="form-control timePicker">
                                                <span class="input-group-addon custom-addon bg-primary">
                                                    <i class="fa fa-clock-o text-light" aria-hidden="true"
                                                        style="line-height: 36px;"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <label class="fs-17 fw-bold ps-4">Hot O'Dourves</label>
                                        <div class="col-lg-6 form-group">
                                            <label for="butler_style_start_time">Start Time</label>
                                            <div class="input-group " data-placement="bottom" data-align="top"
                                                data-autoclose="false" data-format="hh:mm">
                                                <input data-toggle="tooltip" data-placement="bottom"
                                                    placeholder="06:00 PM" title="Start Time" type="text"
                                                    id="butler_style_start_time" name="butler_style_start_time"
                                                    class="form-control  timePicker">
                                                <span class="input-group-addon custom-addon bg-primary">
                                                    <i class="fa fa-clock-o text-light" aria-hidden="true"
                                                        style="line-height: 36px;"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 form-group">
                                            <label for="butler_style_end_time">End Time</label>
                                            <div class="input-group " data-placement="bottom" data-align="top"
                                                data-autoclose="false" data-format="hh:mm">
                                                <input data-toggle="tooltip" data-placement="bottom"
                                                    placeholder="10:00 PM" title="End Time" type="text"
                                                    id="butler_style_end_time" name="butler_style_end_time" required
                                                    class="form-control timePicker">
                                                <span class="input-group-addon custom-addon bg-primary">
                                                    <i class="fa fa-clock-o text-light" aria-hidden="true"
                                                        style="line-height: 36px;"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <label class="fs-17 fw-bold ps-4">Cold O'Dourves</label>
                                        <div class="col-lg-6 form-group">
                                            <label for="butler_style_start_time_1">Start Time</label>
                                            <div class="input-group " data-placement="bottom" data-align="top"
                                                data-autoclose="false" data-format="hh:mm">
                                                <input data-toggle="tooltip" data-placement="bottom"
                                                    placeholder="06:00 PM" title="Start Time" type="text"
                                                    id="butler_style_start_time_1" name="butler_style_start_time_1"
                                                    class="form-control  timePicker">
                                                <span class="input-group-addon custom-addon bg-primary">
                                                    <i class="fa fa-clock-o text-light" aria-hidden="true"
                                                        style="line-height: 36px;"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 form-group">
                                            <label for="butler_style_end_time_1">End Time</label>
                                            <div class="input-group " data-placement="bottom" data-align="top"
                                                data-autoclose="false" data-format="hh:mm">
                                                <input data-toggle="tooltip" data-placement="bottom"
                                                    placeholder="10:00 PM" title="End Time" type="text"
                                                    id="butler_style_end_time_1" name="butler_style_end_time_1" required
                                                    class="form-control timePicker">
                                                <span class="input-group-addon custom-addon bg-primary">
                                                    <i class="fa fa-clock-o text-light" aria-hidden="true"
                                                        style="line-height: 36px;"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="d-flex justify-content-end w-100">
                                            <div class="d-inline-block my-2">
                                                <button class="btn ripple btn-primary" id="submitBtn">Save &
                                                    Continue</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var submitButton = document.getElementById('submitBtn');
        var form = document.getElementById('formid'); // Assuming your form ID is 'formid'

        submitButton.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default form submission
            Swal.fire({
                title: 'Do you want Equipment?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Proceed to navigate to addon page or handle as needed
                    submitForm(true);
                } else {
                    submitForm(false);
                }
            });
        });

        // Function for form submission based on user's choice
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
    });
</script>

    <script>
        const descriptions = {
            "1": `<b>Buffet Style</b> - Most common way of serving food, food on Buffet table in serviceware and chaffers, Guest help themselves as Servers refill and Maintain the buffet.
                  <ul>
                      <li>1 Buffet for 80-150 Guests</li>
                      <li>Double Sided Lines</li>
                      <li>Duration approx 15-30 Minutes (for the last person to be served)</li>
                      <li>We recommend serving food for a minimum of 45 minutes and a maximum of 90 but no more than 2 hours</li>
                  </ul>
                  <b>Appetizer Sequence:</b>
                  <div id="appetizer_sequence" class="draggable-container">
                      <h3>Appetizer Sequence</h3>
                      <ul id="appetizers" class="draggable-list">
                          <li draggable="true">First item</li>
                          <li draggable="true">Second Item - Vegetarian Item</li>
                          <li draggable="true">Third Item - Meat Item</li>
                          <li draggable="true">Cold Item</li>
                          <li draggable="true">Last - Condiments/ Sauces</li>
                      </ul>
                  </div>
                  <b>Main Course Sequence:</b>
                  <div id="main_course_sequence" class="draggable-container">
                      <h3>Main Course Sequence</h3>
                      <ul id="main_courses" class="draggable-list">
                          <li draggable="true">Biryani (or similar)</li>
                          <li draggable="true">Vegetables (if applies)</li>
                          <li draggable="true">Fusion Items - Pasta’s & Noodles etc.</li>
                          <li draggable="true">Curries (Most popular curry or lesser amount of curry towards end)</li>
                          <li draggable="true">BBQ</li>
                          <li draggable="true">Naan- Specialty Breads towards the end</li>
                          <li draggable="true">Salads at the end Sauces to the very end</li>
                          <li draggable="true">Condiments- May be placed next to Item it pairs with on a riser or at the end</li>
                      </ul>
                  </div>`,
            "2": `<b>Butler Style/Passed O’Dourves</b> - Mostly used for “hand food” or “appetizers” where service staff (most likely of the banquet) serves the food on platters, accompanied by a sauce. Your job as a cook/handler is to have the platters ready for them, filled, cleaned, and garnished. Napkins are used as plates here. Wait Staff will be serving it to the guests. Butler Style Appetizers are generally served in Foyers/Entrances/Welcome Areas where guests are standing/mingling. These areas have Hi Boys scattered throughout the room.
                  <ul>
                      <li>Minimum 2 Items to be passed.</li>
                      <li>1 Wait Staff Per Item Per 100 Guests</li>
                  </ul>`,
            "3": `<b>Displayed Station/Buffet</b> - Similar to a Buffet style service but more complex in terms of design and service ware used to present food. Chaffers are not used here, but heat lamps, Platters, Risers and charcuterie boards. Usually Displayed buffets will have items that are plated in the kitchen then set outside.
                  <ul>
                      <li>1 Displayed Buffet is recommended for 300 Guests</li>
                      <li>6’ Worth of Table space Per Item is Required</li>
                  </ul>`,
            "4": `<b>Family Style</b> - Catering Cooks makes bowls or plates for all items per table and hold items in warmers, garnish and clean at the end as the wait staff serves the food to the guests.
                  <ul>
                      <li>1 Food Handler per Entree</li>
                      <li>1 Cook per Station</li>
                      <li>1 Wait Staff per 3 Tables</li>
                  </ul>`,
            "5": `<b>Platted/Course Meals</b> - Here Individual plates are made per person, plates are made as Banquet Staff takes them away.
                  <ul>
                      <li>1 Food Handler per Entree</li>
                      <li>1 Cook per Station</li>
                      <li>1 Wait Staff per Table</li>
                  </ul>`,
            "6": `<b>Action Station</b> - Catering Staff/Cooks are now behind the station, preparing and serving the guests as they come up.
                  <ul>
                      <li>Total of 1 Action Station for 50 Guests is recommended (Example, 300 Guests should have a total of 6 Stations)</li>
                      <li>1 Action Station can serve up to 150 Guests for appetizers/Desserts</li>
                  </ul>`,
            "7": `<b>Live Barbecue</b> - Here a Remote Kitchen is set up in front of the guests and outdoors, as we cook the food on the spot and then serve it to them, mostly buffet style. Remote Kitchen Equipment Involves Deep Fryers, Charcoal Pits, Griddles and Portable Ovens. Depending on the Menu and Clients requirements.`
        };


        document.getElementById('service_type').addEventListener('change', function() {
            const descriptionDiv = document.getElementById('description');
            descriptionDiv.classList.remove('d-none');
            descriptionDiv.innerHTML = descriptions[this.value] || '';
            loadItems(this.value); // Load items for the selected service type
        });

        function loadItems(serviceType) {
            const appetizers = @json($appetizer);
            const mainCourses = @json($main);

            // Simulated data for appetizers and main courses

            const appetizerList = document.getElementById('appetizers');
            const mainCourseList = document.getElementById('main_courses');

            appetizerList.innerHTML = '';
            mainCourseList.innerHTML = '';

            if (serviceType === '1') { // Buffet Style
                if (appetizers) {
                    appetizers.forEach((appetizer, index) => {
                        appetizerList.innerHTML += `<li draggable="true">
                            ${appetizer.name}
                            <input type="hidden" name="appetizer_order[]" value="${index + 1}">
                            </li>`;
                    });
                }
                if (mainCourses) {
                    mainCourses.forEach((mainCourse, index) => {
                        mainCourseList.innerHTML += `<li draggable="true">
                        ${mainCourse.name}
                        <input type="hidden" name="main_course_order[]" value="${index + 1}">
                        </li>`;
                    });

                }
                initDragAndDrop(); // Reinitialize drag-and-drop functionality
            }
            // Add conditions for other service types if needed
        }

        function initDragAndDrop() {
            const draggables = document.querySelectorAll('.draggable-list li');
            const containers = document.querySelectorAll('.draggable-list');

            draggables.forEach(draggable => {
                draggable.addEventListener('dragstart', () => {
                    draggable.classList.add('dragging');
                });

                draggable.addEventListener('dragend', () => {
                    draggable.classList.remove('dragging');
                    updateSortOrder(); // Update sort order when dragging ends
                });
            });

            containers.forEach(container => {
                container.addEventListener('dragover', e => {
                    e.preventDefault();
                    const afterElement = getDragAfterElement(container, e.clientY);
                    const dragging = document.querySelector('.dragging');
                    if (afterElement == null) {
                        container.appendChild(dragging);
                    } else {
                        container.insertBefore(dragging, afterElement);
                    }
                });
            });
        }

        // Function to get the element after which the dragged item should be placed
        function getDragAfterElement(container, y) {
            const draggableElements = [...container.querySelectorAll('li:not(.dragging)')];

            return draggableElements.reduce((closest, child) => {
                const box = child.getBoundingClientRect();
                const offset = y - box.top - box.height / 2;
                if (offset < 0 && offset > closest.offset) {
                    return {
                        offset: offset,
                        element: child
                    };
                } else {
                    return closest;
                }
            }, {
                offset: Number.NEGATIVE_INFINITY
            }).element;
        }

        // Function to update the sort order and store it in hidden input fields
        function updateSortOrder() {
            const appetizerList = document.getElementById('appetizers');
            const mainCourseList = document.getElementById('main_courses');
            const appetizerItems = appetizerList.querySelectorAll('li');
            const mainCourseItems = mainCourseList.querySelectorAll('li');

            // Update sort order for appetizers
            appetizerItems.forEach((item, index) => {
                item.querySelector('input[name="appetizer_order[]"]').value = index + 1;
            });

            // Update sort order for main courses
            mainCourseItems.forEach((item, index) => {
                item.querySelector('input[name="main_course_order[]"]').value = index + 1;
            });
        }

        // Initialize drag-and-drop functionality on page load
        document.addEventListener('DOMContentLoaded', initDragAndDrop);
    </script>
    <script>
        $(document).ready(function() {
            $('#start_time').change(function() {
                const startTime = $(this).val();
            });

            // Function to add minutes to a given time
            function addMinutes(time, minutes) {
                const [hours, mins] = time.split(':').map(Number);
                const totalMinutes = hours * 60 + mins + minutes;
                const newHours = Math.floor(totalMinutes / 60);
                const newMins = totalMinutes % 60;

                // Format the result as HH:MM
                return `${String(newHours).padStart(2, '0')}:${String(newMins).padStart(2, '0')}`;
            }

        });
    </script>
    <script>
        var controls = {
            leftArrow: '<i class="fa fa-angle-left" style="font-size: 1.25rem"></i>',
            rightArrow: '<i class="fa fa-angle-right" style="font-size: 1.25rem"></i>'
        }

        $(document).ready(function() {
            $('#datepickerr').datepicker({

                todayHighlight: true,
                orientation: "bottom left",
                templates: controls
            });
        })


        $(document).ready(function() {

            // toggleOtherOccasionInput();
            toggleOtherTypeInput();

        })
    </script>
    <script>
        var firstOpen = true;
        var time;

        $('#start_time').datetimepicker({

            useCurrent: false,
            format: "hh:mm A",
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            }
        }).on('dp.show', function() {
            if (firstOpen) {
                time = moment().startOf('day');
                firstOpen = false;
            } else {
                time = "01:00 PM"
            }
            $(this).data('DateTimePicker').date(time);
        });
        var endfirstOpen = true;
        var endtime;

        $('#end_time').datetimepicker({
            useCurrent: false,
            format: "hh:mm A",
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            }
        }).on('dp.show', function() {
            if (endfirstOpen) {
                endtime = moment().startOf('day');
                endfirstOpen = false;
            } else {
                endtime = "01:00 PM"
            }
            $(this).data('DateTimePicker').date(endtime);
        });
        $('#main_course_start_time').datetimepicker({
            useCurrent: false,
            format: "hh:mm A",
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            }
        }).on('dp.show', function() {
            // Your logic for start time picker
        });

        // For Main Course end time
        $('#main_course_end_time').datetimepicker({
            useCurrent: false,
            format: "hh:mm A",
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            }
        }).on('dp.show', function() {
            // Your logic for end time picker
        });

        // For Dessert start time
        $('#dessert_start_time').datetimepicker({
            useCurrent: false,
            format: "hh:mm A",
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            }
        }).on('dp.show', function() {
            // Your logic for dessert start time picker
        });

        // For Dessert end time
        $('#dessert_end_time').datetimepicker({
            useCurrent: false,
            format: "hh:mm A",
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            }
        }).on('dp.show', function() {
            // Your logic for dessert end time picker
        });
        // For Dessert start time
        $('#butler_style_start_time').datetimepicker({
            useCurrent: false,
            format: "hh:mm A",
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            }
        }).on('dp.show', function() {
            // Your logic for butler_style start time picker
        });

        // For Butler_style end time
        $('#butler_style_end_time').datetimepicker({
            useCurrent: false,
            format: "hh:mm A",
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            }
        }).on('dp.show', function() {
            // Your logic for butler_style end time picker
        });
        $('#butler_style_start_time_1').datetimepicker({
            useCurrent: false,
            format: "hh:mm A",
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            }
        }).on('dp.show', function() {
            // Your logic for butler_style start time picker
        });

        // For Butler_style end time
        $('#butler_style_end_time_1').datetimepicker({
            useCurrent: false,
            format: "hh:mm A",
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            }
        }).on('dp.show', function() {
            // Your logic for butler_style end time picker
        });
    </script>
@endsection
