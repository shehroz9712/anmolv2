<style>
    #user-initials {
        font-family: Verdana, Geneva, Tahoma, sans-serif, Helvetica, sans-serif;
        font-size: 12px;
        /* Adjust the font size as needed */
        /* font-weight: bold; */
        display: flex;
        letter-spacing: .8px;
        align-items: center;
        justify-content: center;
        background-color: #1d212f;
        color: #fff;
        border-radius: 100%
    }

    .main-user-icon {
        font-size: 12px;
        display: inline-block !important;
        width: 30px !important;
        /* Make the width and height equal for a perfect circle */
        height: 30px !important;
        border-radius: 50%;
        /* Make it round */
        background-color: #1d212f;
        /* Add background color */
        color: #fff;
        /* Set the text color to white */
        text-align: center;
        /* Center the text horizontally and vertically */
        line-height: 30px;
        /* Center the text vertically */
    }
</style>
<div class="main-header side-header sticky">
    <div class="main-container container-fluid">
        <div class="main-header-left">
            <a class="main-header-menu-icon" href="javascript:void(0)" id="mainSidebarToggle"><span></span></a>
            <div class="hor-logo">
                <a class="main-logo" href="{{ route('index') }}">
                    <img src="../assets/img/brand/logo.png" class="header-brand-img desktop-logo" alt="logo">
                    <img src="../assets/img/brand/logo-light.png" class="header-brand-img desktop-logo-dark"
                        alt="logo">
                </a>
            </div>
        </div>
        <div class="main-header-center">
            <div class="responsive-logo">
                <a href="{{ route('index') }}"><img src="../assets/img/brand/logo.png" height="50px"
                        class="mobile-logo" alt="logo"></a>
                <a href="{{ route('index') }}"><img src="../assets/img/brand/logo-light.png" height="50px"
                        class="mobile-logo-dark" alt="logo"></a>
            </div>

        </div>
        <div class="main-header-right">
            <button class="navbar-toggler navresponsive-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4"
                aria-expanded="false" aria-label="Toggle navigation">
                <i class="fe fe-more-vertical header-icons navbar-toggler-icon"></i>
            </button><!-- Navresponsive closed -->
            <div class="navbar navbar-expand-lg  nav nav-item  navbar-nav-right responsive-navbar navbar-dark  ">
                <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                    <div class="d-flex order-lg-2 ms-auto">


                        <a class="nav-link icon full-screen-link">
                            <i class="fe fe-maximize fullscreen-button fullscreen header-icons"></i>
                            <i class="fe fe-minimize fullscreen-button exit-fullscreen header-icons"></i>
                        </a>
                    </div>
                    <!-- Full screen -->
                    <!-- Notification -->
                    <div class="dropdown main-header-notification">
                        <a class="nav-link icon" href="">
                            <i class="fe fe-bell header-icons"></i>
                            <span
                                class="badge bg-danger nav-link-badge">{{ $admin_notifications->where('is_read', 0)->count() }}</span>
                        </a>
                        <div class="dropdown-menu">
                            <div class="header-navheading">
                                <p class="main-notification-text">You have

                                    <a href="{{ route('user.notification.list') }}"> <span class="noti-count">
                                            {{ $admin_notifications->where('is_read', 0)->count() }}</span> unread
                                        notifications<span class="badge bg-pill bg-primary ms-3">View all</span></a>
                                </p>
                            </div>
                            <div class="main-notification-list">
                                @foreach ($admin_notifications as $notification)
                                    <div class="media {{ $notification->is_read ? '' : 'new' }}"
                                        data-subject="{{ $notification->subject }}"
                                        data-message="{{ $notification->message }}"
                                        data-notification-id="{{ $notification->id }}" data-toggle="modal"
                                        data-target="#notificationModal">
                                        {{-- <div class="main-img-user online"><i class="fe fe-bell header-icons"></i></div> --}}
                                        <div class="align-items-center d-flex justify-content-between media-body">
                                            <div>

                                                <p>{{ Illuminate\Support\Str::limit($notification->subject, 20, '...') }}
                                                </p>
                                                <p>{{ Illuminate\Support\Str::limit($notification->message, 20, '...') }}
                                                </p>
                                            </div>
                                            <span>{{ $notification->created_at ? $notification->created_at->diffForHumans() : '' }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="dropdown-footer">
                                <a href="{{ route('user.notification.list') }}">View All Notifications</a>
                            </div>
                        </div>

                    </div>
                    <!-- Notification -->
                    <!-- Profile -->
                    <div class="dropdown main-profile-menu">
                        <a class="d-flex text-center justify-content-center" href="javascript:void(0)">
                            {{-- <span class="main-img-user user-avatar">
                                    <img alt="avatar" id="user-avatar" src="../assets/img/users/1.jpg">
                                </span> --}}
                            <span class="main-img-user" id="user-initials">ST</span>
                        </a>
                        <div class="dropdown-menu">
                            <div class="header-navheading">
                                <h6 class="main-notification-title">
                                    @if (Auth::check())
                                        <span class="main-user-icon" id="user-initials2">ST</span>
                                        <span> {{ Auth::user()->name }}</span>
                                    @else
                                        Guest
                                    @endif
                                </h6>
                                <p class="main-notification-text">
                                    @if (Auth::check())
                                        {{ Auth::user()->email }}
                                    @else
                                        Guest
                                    @endif
                                </p>
                            </div>

                            <a class="dropdown-item border-top" href="{{ route('profile.index') }}"
                                @disabled(true)>
                                <i class="fe fe-user"></i> My Profile
                            </a>

                            <form method="POST" action="{{ route('auth.logout') }}">
                                @csrf <!-- Include a CSRF token for security -->
                                @if (Auth::user()->Role == 'Guest')
                                    <a class="dropdown-item" href="#"
                                        onclick="event.preventDefault();
                                        showGuestSignOutModal();"
                                        data-bs-target="#guestSignOutModal" data-bs-toggle="modal">
                                        <i class="fe fe-power"></i> Sign Out
                                    </a>
                                @else
                                    <a class="dropdown-item" href="#"
                                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                        <i class="fe fe-power"></i> Sign Out
                                    </a>
                                @endif
                            </form>




                            <script>
                                function showGuestSignOutModal() {
                                    $('#guestSignOutModal').modal('show');
                                }
                            </script>

                        </div>
                    </div>
                    <!-- Profile -->
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notificationModalLabel">Notification Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6 id="modalSubject"></h6>
                <p id="modalMessage"></p>
            </div>
        </div>
    </div>
</div>


<div class="d-none" id="Username">{{ Auth::user()->name }}</div>
<script>
    // Function to get initials from a full name
    function getInitials(fullName) {
        const names = fullName.split(' ');
        let initials = '';

        for (let i = 0; i < names.length; i++) {
            initials += names[i].charAt(0);
        }

        return initials;
    }

    // Replace the image source with the user's initials
    // const element = document.getElementsByClassName('main-notification-title')[0]; // Replace this with the user's full name
    const element = document.getElementById('Username');
    let fullName = element.innerText;
    // Function to get initials from a full name
    function getInitials(fullName) {
        const names = fullName.split(' ');
        let initials = '';

        for (let i = 0; i < names.length; i++) {
            initials += names[i].charAt(0);
        }

        return initials;
    }

    const initialsElement = document.getElementById('user-initials');

    if (initialsElement) {
        initialsElement.innerText = getInitials(fullName);
    }

    const initialsElement2 = document.getElementById('user-initials2');

    if (initialsElement2) {
        initialsElement2.innerText = getInitials(fullName);
    }
</script>
