@extends('backend.layouts.app', ['activePage' => 'users.panel', 'title' => 'User Profile'])

@push('styles')
    <style>

        .img-circle {
            border-radius: 50%;
        }
    </style>
@endpush

@section('content')

<div class="main-panel" id="app">
    {{-- Navbar Section --}}
    @include('backend.layouts.navbars.navs.auth', ['title' => 'User Profile'])
    {{-- // Navbar Section --}}
    <main class="content">
        <div class="container-fluid" id='user'>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header card-header-info">
                            <h4 class="card-title"> Profile of {{$user['fname']}}</h4>
                            <div class="float-right ">
                                <a class="btn btn-info" href="{{ route('admin.profile.edit') }}" title="Edit User"><i class="fa fa-edit"></i> Edit Profile</a> &nbsp;&nbsp;&nbsp;
                                <a class="btn btn-secondary" href="{{ route('admin.password.change') }}" title="Change Password"><i class="fa fa-key"></i> Change Password</a>
                            </div>
                        </div>
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="card card-primary card-outline mt-0">
                                        <div class="card-body box-profile table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr style="border-bottom: 1px solid #ddd">
                                                        <th colspan="2" class="text-center">
                                                            <div class="m-auto">
                                                                <img class="img-fluid img-circle" style="max-width: 100px;" src="{{$user->getFirstMediaUrl('avatar')}}" alt="{{$user->name}}'s avatar">
                                                                <div><h4>{{$user->name}}</h4></div>
                                                                <div class="text-muted">
                                                                    {{$user->role}}
                                                                </div>
                                                            </div>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr style="border-bottom: 1px solid #ddd">
                                                        <th class="text-left">
                                                            Username
                                                        </th>
                                                        <td class="text-right text-muted">
                                                            {{$user->username}}
                                                        </td>
                                                    </tr>
                                                    <tr style="border-bottom: 1px solid #ddd">
                                                        <th class="text-left">
                                                            Status
                                                        </th>
                                                        <td class="text-right text-muted">
                                                            {{$user->status->name}}
                                                        </td>
                                                    </tr>
                                                    <tr style="border-bottom: 1px solid #ddd">
                                                        <th class="text-left">
                                                            Email
                                                        </th>
                                                        <td class="text-right text-muted">
                                                            {{$user->email}}
                                                        </td>
                                                    </tr>
                                                    <tr style="border-bottom: 1px solid #ddd">
                                                        <th class="text-left">
                                                            Since
                                                        </th>
                                                        <td class="text-right text-muted">
                                                            {{$user->created_at}}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card -->
                                <div class="col-md-7">
                                    <div class="card card-primary card-outline mt-0">
                                        <!-- About Me Box -->
                                        <div class="card-body table-responsive">
                                            <table class="table">
                                                <tbody>
                                                    <tr style="border-bottom: 1px solid #ddd">
                                                        <th class="text-left">
                                                            Date of Birth
                                                        </th>
                                                        <td class="text-right text-muted">
                                                            {{$user->dob}}
                                                        </td>
                                                    </tr>
                                                    <tr style="border-bottom: 1px solid #ddd">
                                                        <th class="text-left" style="border-top: 0;">
                                                            Phone
                                                        </th>
                                                        <td class="text-right text-muted">
                                                            {{$user->phone}}
                                                        </td>
                                                    </tr>
                                                    <tr style="border-bottom: 1px solid #ddd">
                                                        <th class="text-left">
                                                            City
                                                        </th>
                                                        <td class="text-right text-muted">
                                                            {{$user->city}}
                                                        </td>
                                                    </tr>
                                                    <tr style="border-bottom: 1px solid #ddd">
                                                        <th class="text-left">
                                                            Zip Code
                                                        </th>
                                                        <td class="text-right text-muted">
                                                            {{$user->zip_code}}
                                                        </td>
                                                    </tr>
                                                    <tr style="border-bottom: 1px solid #ddd">
                                                        <th class="text-left">
                                                            Country
                                                        </th>
                                                        <td class="text-right text-muted">
                                                            {{$user->country}}
                                                        </td>
                                                    </tr>
                                                    <tr style="border-bottom: 1px solid #ddd">
                                                        <th class="text-left">
                                                            Postal Address
                                                        </th>
                                                        <td class="text-right text-muted">
                                                            {{$user->postal_address}}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.card-body -->
                                    <!-- /.card -->
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                        </div>
                    </div>
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

