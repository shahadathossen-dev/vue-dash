<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container-fluid">
        <span class="nav-item">
            <button class="btn btn-outline-primary button-collapse nav-link" data-activates="slide-out">
                <i class="material-icons">dehaze</i>
            </button>
        </span>
        <div class="navbar-wrapper">
            <a class="navbar-brand" href="#">{{ $titlePage }}</a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end">
            <form class="navbar-form">
                <div class="input-group no-border">
                    <input type="text" value="" class="form-control" placeholder="Search...">
                    <button type="submit" class="btn btn-white btn-round btn-just-icon">
                    <i class="material-icons">search</i>
                    <div class="ripple-container"></div>
                    </button>
                </div>
            </form>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="material-icons">dashboard</i>
                        <p class="d-lg-none d-md-block">
                            {{ __('Stats') }}
                        </p>
                    </a>
                </li>
                <li class="nav-item dropdown notifications">
                    <a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="material-icons">notifications</i>
                        <span class="notification count">@{{notifications.length}}</span>
                        <p class="d-lg-none d-md-block">
                            {{ __('Some Actions') }}
                        </p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <div class="notifications" style="max-height: 400px; overflow-x: auto; width: 300px;">

                            <a class="dropdown-item notification-item" v-for="notification in notifications" :href="notification.data.route" :data-notification="'{{url("notifications")}}/'+notification.id+'/read'">
                            {{-- <a class="dropdown-item notification-item" v-for="notification in notifications" :href="notification.data.route" :data-notification="notification.id"> --}}
                                <span><small class="mr-1"><i class="fa fa-circle"></i></small> @{{ notification.data.title }}</span> <span class="ml-auto"> @{{notification.created_at | dateTime}}</span>
                            </a>
                            <div class="text-center dropdown-item border-bottom-0" style="" v-if="notifications.length < 1">
                                <span class="text-center w-100">No unread notifications.</span>
                            </div>
                        </div>

                        <div class="dropdown-divider"></div>
                        <div class="text-center">
                            <a class="bg-grey show-all w-50 d-inline-block" href="{{route('notifications.panel')}}">Show all </a><a class="bg-grey mark-all w-49 d-inline-block w-50" href="{{route('notifications.read.all')}}"> Mark all as read</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="material-icons">person</i>
                        <p class="d-lg-none d-md-block">
                        {{ __('Account') }}
                        </p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a>
                        <a class="dropdown-item" href="#">{{ __('Settings') }}</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Log out') }}</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</nav>
<!-- Navbar -->

@push('js')
<script>
    $(document).ready(function() {
        // auth
        $('body').on('click', '.notification-item', function(event){
            event.preventDefault();
            let targetPage = $(this).attr('href');
            let notificationMarkAsRead = $(this).data('notification');

            $.ajax({
                url: notificationMarkAsRead, // Get the action URL to send AJAX to
                type: "get",
                success: (res => {
                    window.location.href = targetPage;
                }),
                error: (err => {
                    if (xhr.status == 'warning') {
                        app.$toastr.error(xhr.message, xhr.status);
                    } else {
                        app.$toastr.error(xhr.responseJSON.message, xhr.status);
                    }
                }),
            });
        });

        $('body').on('click', '.mark-all', function(event){
            event.preventDefault();
            event.stopPropagation();

            let markAllAsRead = $(this).attr('href');
            $.ajax({
                url: markAllAsRead, // Get the action URL to send AJAX to
                type: "get",
                success: (res => {
                    app.getNotifications();
                }),
                error: (err => {
                    if (xhr.status == 'warning') {
                        app.$toastr.error(xhr.message, xhr.status);
                    } else {
                        app.$toastr.error(xhr.responseJSON.message, xhr.status);
                    }
                }),
            });
        });
    });

</script>
@endpush

