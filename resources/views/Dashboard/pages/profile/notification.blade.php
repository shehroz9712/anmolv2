@extends('Dashboard.Master.master_layout')
@section('content')
    <div class=" pt-0">

        <div class="main-container container-fluid">
            <div class="inner-body">

                <div class="container">
                    <ul class="notification">
                        @foreach ($notifications as $item)
                            @php

                                $createdAt = \Carbon\Carbon::parse($item->created_at);

                                // If the timestamp is from today, display "Today" instead of the date
                                $formattedTimestamp = $createdAt->format('H:i');
                                $daysDifference = $createdAt->diffInDays(\Carbon\Carbon::now(), false);

                                // Check for special cases: Today, Yesterday, Tomorrow
                                if ($createdAt->isToday()) {
                                    $day = 'Today';
                                } elseif ($createdAt->isYesterday()) {
                                    $day = 'Yesterday';
                                } elseif ($createdAt->isTomorrow()) {
                                    $day = 'Tomorrow';
                                } elseif ($daysDifference == 6) {
                                    $day = 'One week ago';
                                } elseif ($daysDifference < 7) {
                                    $day = $daysDifference . ' days ago';
                                } else {
                                    $day = $createdAt->format('M j'); // Format for dates older than a week
                                }
                            @endphp
                            <li>
                                <div class="notification-time">
                                    <span class="date">{{ $day }} </span>
                                    <span class="time">{{ $formattedTimestamp }}</span>
                                </div>
                                <div class="notification-icon">
                                    <a href="javascript:void(0);"></a>
                                </div>
                                <div class="notification-time-date mb-2 d-block d-md-none">
                                    <span class="date">{{ $day }}</span>
                                    <span class="time ms-2">{{ $formattedTimestamp }}</span>
                                </div>
                                <div class="notification-body">
                                    <div class="media mt-0">

                                        <div class="media-body ms-3 d-flex">
                                            <div class="">
                                                <p class="tx-14 text-dark mb-0 tx-semibold">{{ $item->subject }}</p>
                                                <p class="mb-0 tx-13 text-muted">{{ $item->message }}</p>
                                            </div>
                                            <div class="notify-time">
                                                <p class="mb-0 text-muted tx-11">
                                                    {{ $item->created_at ? $item->created_at->diffForHumans() : '' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach


                    </ul>
                    <div class="text-center mb-4">
                        <a href="javascript:void(0);" class="btn ripple btn-primary w-md" role="button">Load
                            more</a>
                    </div>
                </div>
                <!-- End Container -->

            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection
