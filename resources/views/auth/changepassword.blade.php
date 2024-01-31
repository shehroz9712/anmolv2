<!-- resources/views/auth/change-password.blade.php -->

@extends('Dashboard.Master.master_layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Change Password') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('password.change') }}" id="changePasswordForm">
                            @csrf

                            <div class="form-group">
                                <label for="current_password">Current Password</label>
                                <input
                                    type="password"
                                    id="current_password"
                                    name="current_password"
                                    class="form-control"
                                    required
                                />
                                <small class="text-danger" id="currentPasswordHelp"></small>
                            </div>

                            <div class="form-group">
                                <label for="new_password">New Password</label>
                                <input
                                    type="password"
                                    id="new_password"
                                    name="new_password"
                                    class="form-control"
                                    minlength="8"
                                    pattern="(?=.*\d).{8,}"
                                    title="Must contain at least one number and be at least 8 characters long."
                                    required
                                />
                                <small class="text-danger" id="newPasswordHelp">Must contain at least one number and be at least 8 characters long.</small>
                            </div>

                            <div class="form-group">
                                <label for="new_password_confirmation">Confirm New Password</label>
                                <input
                                    type="password"
                                    id="new_password_confirmation"
                                    name="new_password_confirmation"
                                    class="form-control"
                                    required
                                />
                                <small class="text-danger" id="confirmPasswordHelp"></small>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">
                                {{ __('Change Password') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add event listener for input blur (leave) event
        document.getElementById('current_password').addEventListener('blur', function () {
            validateCurrentPassword();
        });

        document.getElementById('new_password').addEventListener('blur', function () {
            validateNewPassword();
        });

        document.getElementById('new_password_confirmation').addEventListener('blur', function () {
            validateConfirmPassword();
        });

        // Add event listener for form submission
        document.getElementById('changePasswordForm').addEventListener('submit', function (event) {
            if (!validateForm()) {
                // If validation fails, prevent form submission
                event.preventDefault();
            }
        });

        // Function to validate current password
        function validateCurrentPassword() {
            var currentPasswordInput = document.getElementById('current_password');
            var currentPassword = currentPasswordInput.value;

            // Your validation logic for current password

            var currentPasswordHelp = document.getElementById('currentPasswordHelp');
            // Example validation: check if the current password is not empty
            if (currentPassword.trim() === '') {
                currentPasswordHelp.innerText = 'Current Password is required.';
                currentPasswordHelp.style.color = 'red';
                return false;
            } else {
                currentPasswordHelp.innerText = '';
                currentPasswordHelp.style.color = 'inherit';
                return true;
            }
        }

        // Function to validate new password
        function validateNewPassword() {
            var newPasswordInput = document.getElementById('new_password');
            var newPassword = newPasswordInput.value;

            // Use a regular expression to check for at least one digit
            var regex = /^(?=.*\d).{8,}$/;

            var newPasswordHelp = document.getElementById('newPasswordHelp');

            if (!regex.test(newPassword)) {
                // If validation fails, show the error message
                newPasswordHelp.innerText = 'Must contain at least one number and be at least 8 characters long.';
                newPasswordHelp.style.color = 'red';
                return false;
            } else {
                // If validation passes, reset the error message
                newPasswordHelp.innerText = '';
                newPasswordHelp.style.color = 'inherit';
                return true;
            }
        }

        // Function to validate confirm password
        function validateConfirmPassword() {
            var newPasswordInput = document.getElementById('new_password');
            var confirmPasswordInput = document.getElementById('new_password_confirmation');
            var confirmPassword = confirmPasswordInput.value;

            var confirmPasswordHelp = document.getElementById('confirmPasswordHelp');

            // Example validation: check if the confirm password matches the new password
            if (confirmPassword !== newPasswordInput.value) {
                confirmPasswordHelp.innerText = 'Confirm Password must match New Password.';
                confirmPasswordHelp.style.color = 'red';
                return false;
            } else {
                confirmPasswordHelp.innerText = '';
                confirmPasswordHelp.style.color = 'inherit';
                return true;
            }
        }

        // Function to validate the entire form
        function validateForm() {
            var isCurrentPasswordValid = validateCurrentPassword();
            var isNewPasswordValid = validateNewPassword();
            var isConfirmPasswordValid = validateConfirmPassword();

            return isCurrentPasswordValid && isNewPasswordValid && isConfirmPasswordValid;
        }
    </script>
@endsection
