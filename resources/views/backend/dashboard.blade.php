@extends('backend.layouts.app', ['activePage' => 'dashboard', 'title' => 'Dashboard'])

@push('styles')

@endpush

@section('content')

<div class="main-panel" id="app">
    {{-- Navbar Section --}}
    @include('backend.layouts.navbars.navs.auth', ['title' => 'Dashboard'])
    {{-- // Navbar Section --}}

    <main class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Dashboard</div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            You are logged in!

                            {{-- <example-component></example-component> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    {{-- <example-component notification-route="{{route('notifications.unread')}}" auth-user="{{auth("admin")->user()->id}}"></example-component> --}}

    {{-- Footer Section --}}
    @include('backend.layouts.footers.auth')
    {{-- Footer Section --}}
</div>

@endsection

@push('scripts')
<script>
        // Tooltip Initialization
        // $(function () {
            // Something will go here.
        // });


    const app = new Vue({
        el: '#app',
        data:{
            authUser : '{{auth("admin")->user()->id}}',
            notifications : [],
        },
        filters: {
            dateTime: function (datetime) {
                if (!datetime) {
                    return 'N/A'
                }
                return moment(datetime).format('YYYY-MM-DD HH:mm:ss');
                // return moment(date, 'YYYY-MM-DD').format(format);
            },
            snake_to_sentence: function (snake) {
                let wordsArray = snake.split('_');
                let name = wordsArray.join(' ');
                return capitalize(name);
            },
        },
        methods: {
            getNotifications(){
                axios.get('{{route("notifications.unread")}}')
                    .then(res=>{
                        this.$nextTick(function () {
                            this.notifications = res.data;
                        });
                    })
                    .catch(e=>{
                        alert(e);
                    })
            },

        },
        created() {
            this.getNotifications();
            // Subscribe to private notifications
            Echo.private('App.Models.Backend.User.' + this.authUser)
                .notification((notification) => {
                    this.getNotifications();
                    this.$toastr.info(notification.message, notification.title);

                });
            // Subscribe to public notifications
            Echo.private('App.Models.Backend.User')
                .notification((notification) => {
                    console.log(notification);
                });
        }
    })
</script>
@endpush
