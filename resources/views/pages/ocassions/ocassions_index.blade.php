@extends('Dashboard.Master.master_layout')

@section('title')
EatAnmol - Manage Ocassions
@endsection
@section('content')

<div class="inner-body">

    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">Welcome to Eatanmol</h2>
             <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Ocassions</li>
            </ol>
        </div>
        <div class="d-flex">
            <div class="justify-content-center">
                <button type="button" class="btn btn-white btn-icon-text my-2 me-2">
                    <i class="fe fe-download me-2"></i> Import
                </button>
                <button type="button" class="btn btn-white btn-icon-text my-2 me-2">
                    <i class="fe fe-filter me-2"></i> Filter
                </button>
                <button type="button" data-bs-target="#addOccasionModal" data-bs-toggle="modal" class="btn btn-primary my-2 btn-icon-text">
                    <i class="fe fe-plus me-2"></i> Add Ocassion
                </button>
            </div>
        </div>
    </div>
    <!-- End Page Header -->

    <!--Row-->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card p-3 mg-b-20">
                <div class="card-body">
                    <div class="card-header border-bottom-0 pt-0 ps-0 pe-0 d-flex">
                        <div>
                            <label class="main-content-label mb-2">Ocassions</label>
                             {{-- <span class="d-block tx-12 mb-3 text-muted">A task is accomplished by
                                a set deadline, and must contribute toward work-related
                                objectives.</span> --}}
                        </div>
                    </div>
                    <br>
                  <div class="container">
                    <div class="table-responsive tasks">
                        <table class="table card-table table-vcenter text-nowrap mb-0 border">
                            <thead>
                                <tr>
                                    <th class="wd-lg-10p">ID</th>
                                    <th class="wd-lg-40p">Name</th>
                                    <th class="wd-lg-20p">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($occasions as $occasion)
                                    <tr>
                                        <td>{{ $occasion->id }}</td>
                                        <td>{{ $occasion->name }}</td>
                                        <td>
                                            {{-- <a href="{{ route('occasions.edit', $occasion->id) }}" class="btn btn-primary px-3">Edit</a> --}}
                                            <div class="main-dropdown-form-demo" style="display: inline-block">
                                                <button class="btn ripple btn-main-primary  px-4 pd-x-20" data-bs-toggle="dropdown">Edit &nbsp; <i class="icon ion-ios-arrow-down mg-l-5 tx-12"></i></button>
                                                <div class="dropdown-menu" id="editDropdown">
                                                    <h6 class="dropdown-title text-center mb-4">Edit</h6>
                                                    <form method="POST" id="editOcassionForm" action="{{ route('occasions.update', $occasion->id) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group">
                                                            <input class="form-control" id="OcassionNameEdit" name="name" placeholder="Edit Occasion Name" type="text" required value="{{ $occasion->name }}">
                                                            <small class="text-danger" id="nameEditError"></small>

                                                        </div>
                                                        <button type="button" onclick="validateAndSubmitEditForm()" class="btn ripple btn-primary btn-block">Save Changes</button>
                                                    </form>
                                                </div>
                                                
                                            </div>
                                            <form action="{{ route('occasions.destroy', $occasion->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger px-4" onclick="return confirm('Are you sure you want to delete this occasion?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                  </div>
                    
                    
                </div>
            </div>
        </div>
    </div><!-- Row end -->
</div>
<div class="modal" id="addOccasionModal">
    <div class="modal-dialog wd-xl-400" role="document">
        <div class="modal-content">
            <div class="modal-body pd-20 pd-sm-40">
                <button aria-label="Close" class="close pos-absolute t-15 r-20 tx-26" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title mb-4 text-center">Add New Occasion</h5>
                <form method="POST" action="{{ route('occasions.store') }}">
                    @csrf
                    <div class="form-group">
                        <input class="form-control" id="OcassionNameAdd" name="name" placeholder="Occasion Name" type="text" required>
                        <small class="text-danger" id="nameError"></small>
                    </div>
                    <button type="button" class="btn ripple btn-primary btn-block" onclick="validateAndSubmitForm()">Add Occasion</button>

                </form>
            </div>
        </div>
    </div>
</div>


@endsection
@section('js')
<script>
    function validateAndSubmitForm() {
        // const nameInput = document.querySelector('[name="name"]');
        const nameInput = document.querySelector('#OcassionNameAdd');
        const nameError = document.querySelector('#nameError');
        let isValid = true;

        // Check if the name is empty
        if (nameInput.value.trim() === '') {
            nameError.textContent = 'Name is required.';
            isValid = false;
        } else if (nameInput.value.length < 3) {
            nameError.textContent = 'Name must be at least 3 characters.';
            isValid = false;
        } else {
            nameError.textContent = ''; // Clear the error message
        }

        if (isValid) {
            // Submit the form if validation passes
            document.querySelector('#addOccasionModal form').submit();
        }
    }
    function validateAndSubmitEditForm() {
        // const nameInput = document.querySelector('[name="name"]');
        const nameInput = document.querySelector('#OcassionNameEdit');
        const nameError = document.querySelector('#nameEditError');
        let isValid = true;

        // Check if the name is empty
        if (nameInput.value.trim() === '') {
            nameError.textContent = 'Name is required.';
            isValid = false;
        } else if (nameInput.value.length < 3) {
            nameError.textContent = 'Name must be at least 3 characters.';
            isValid = false;
        } else {
            nameError.textContent = ''; // Clear the error message
        }

        if (isValid) {
            // Submit the form if validation passes
            document.querySelector('#editOcassionForm').submit();
        }
    }
    document.querySelector('#editDropdown').addEventListener('click', function(event) {
        event.stopPropagation();
    });
</script>

@endsection
