@extends('backend.layouts.app', ['activePage' => 'users.panel', 'title' => 'User Details'])

@push('styles')

@endpush

@section('content')

<div class="main-panel" id="app">
    {{-- Navbar Section --}}
    @include('backend.layouts.navbars.navs.auth', ['title' => 'User Details'])
    {{-- // Navbar Section --}}
    <main class="content">
        <div class="container-fluid" id='user'>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header card-header-info">
                            <h4 class="card-title"> Profile of {{$user['fname']}}</h4>
                            <div class="float-right ">
                                <a class="btn btn-info" v-if="userPending" href="{{ route('admin.users.approve', $user->id) }}" title="Approve User"><i class="fa fa-edit"></i> Approve User</a> &nbsp;&nbsp;&nbsp;
                                <a class="btn btn-info" v-if="selfUser" href="{{ route('admin.profile.edit') }}" title="Edit User"><i class="fa fa-edit"></i> Edit Profile</a> &nbsp;&nbsp;&nbsp;
                                <a class="btn btn-secondary" v-if="selfUser" href="{{ route('admin.password.change') }}" title="Change Password"><i class="fa fa-key"></i> Change Password</a>
                                <button class="btn btn-secondary" v-if="superUser" @click="openPasswordResetModal" title="Reset Password"><i class="fa fa-key"></i> Reset Password</button>
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
            {{-- Create/Edit Modal --}}
            <div class="modal fade password-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form @submit.prevent="resetPasswordEmail">
                            @csrf

                            <div class="modal-header">
                                <h5 class="modal-title" id="createModalLabel"><i class="ti-marker-alt m-r-10"></i> Add New User</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row justify-content-center">
                                    <div class="col-md-6">
                                        <label for="email" >User Email</label>
                                        <input id="email" v-model="form.email" type="email" name="email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control" placeholder="Email">
                                        <has-error :form="form" field="email"></has-error>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success"><i class="ti-save"></i> Send Reset Email</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </form>
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
            superUser : '{{auth("admin")->user()->roleIs("Super Admin")}}',
            button_text: 'Reply',
            loaderButton: '<img src="/box.gif" alt="..." style="width: 30px;">',
            userPending: "{{$user->statusIs('Pending')}}",
            selfUser: "{{$user->id == auth('admin')->user()->id ? true : false}}",
            notifications: [],
            form : new Form({
                email : '{{$user->email}}',
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
            openPasswordResetModal(){
                $('.password-modal').modal('show');
            },
            resetPasswordEmail(){
                this.form.post('{{route("admin.password.email")}}')
                    .then(res=>{
                        this.form.reset();
                        this.$nextTick(function () {
                            $('.password-modal').modal('hide');
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

