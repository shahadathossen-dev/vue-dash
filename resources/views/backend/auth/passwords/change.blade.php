@extends('backend.layouts.app', ['activePage' => 'users.panel', 'title' => 'Users'])

@push('styles')
@endpush

@section('content')

<div class="main-panel" id="app">
    {{-- Navbar Section --}}
    @include('backend.layouts.navbars.navs.auth', ['title' => 'Users'])
    {{-- // Navbar Section --}}
    <main class="content">

        <div class="container-fluid" id='user'>
            <div class="card card-login card-hidden mb-3">
                <div class="card-header card-header-primary text-center">
                    <h4 class="card-title"><strong>{{ __('Change password') }}</strong></h4>
                    <div class="social-line">
                        Make it secure
                    </div>
                </div>

                <div class="card-body">
                    <div class="col-md-6">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                    <form method="POST" @submit.prevent="changePassword" action="{{ route('admin.password.update') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="old_passoword" class="col-md-4 col-form-label text-md-right">{{ __('Old Password') }}</label>

                            <div class="col-md-6">
                                <input id="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" required >

                                @error('old_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Change Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    {{-- Footer Section --}}
    @include('backend.layouts.footers.auth')
    {{-- Footer Section --}}
</div>
@endsection

@push('scripts')
<script>

    const app = new Vue({
        el: '#app',
        data:{
            authUser : '{{auth("admin")->user()->id}}',
            button_text: 'Reply',
            loaderButton: '<img src="/box.gif" alt="..." style="width: 30px;">',
            notifications: [],
            form : new Form({
                old_password : '',
                password : '',
                password_confirmation : '',
            }),
            disabled: false,
        },
        filters: {
            lowercase: function (value) {
                return value.toLowerCase();
            },

            dateTime: function (datetime) {
                if (!datetime) {
                    return 'N/A'
                }
                return moment(datetime).format('YYYY-MM-DD HH:mm:ss');
                // return moment(date, 'YYYY-MM-DD').format(format);
            },
        },

        methods:{
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
            changePassword(){
                this.form.post('{{route("admin.password.update")}}')
                    .then(res=>{
                        this.form.reset();
                        this.$nextTick(function () {
                            this.$toastr.success(res.data.message, res.data.status);
                        });
                    })
                    .catch(e=>{
                        alert(e);
                    })
            },
        },
        created(){
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
