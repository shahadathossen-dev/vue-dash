@extends('backend.layouts.app', ['activePage' => 'users.panel', 'title' => 'Edit Profile'])

@push('styles')
<link rel="stylesheet" href="{{asset('vendor')}}/dropify/css/dropify.css">
<style>
    .dropify-wrapper .dropify-wrapper {
        position: absolute;
        top: 0px;
        left: 0px;
        min-height: 100%;
    }
</style>
@endpush

@section('content')

<div class="main-panel" id="app">
    {{-- Navbar Section --}}
    @include('backend.layouts.navbars.navs.auth', ['title' => 'Edit Profile'])
    {{-- // Navbar Section --}}
    <main class="content">
        <div class="container-fluid" id="edit_user">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-body">
                        <h4 class="card-title"><i class="ti-marker-alt m-r-10"></i> Edit Profile</h4>
                        <form id="profileForm" action="{{route('admin.profile.update')}}" method="POST">
                            <input type="hidden" name="id" v-model="form.id">
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fname" >First Name</label>
                                                <input id="fname" v-model="form.fname" type="text" name="fname" :class="{ 'is-invalid': form.errors.has('fname') }" class="form-control" placeholder="First Name">
                                                <has-error :form="form" field="fname"></has-error>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="lname" >Last Name</label>
                                                <input id="lname" v-model="form.lname" type="text" name="lname" :class="{ 'is-invalid': form.errors.has('lname') }" class="form-control" placeholder="Last Name">
                                                <has-error :form="form" field="lname"></has-error>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email" >User Email</label>
                                                <input id="email" v-model="form.email" type="email" name="email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control" placeholder="Email">
                                                <has-error :form="form" field="email"></has-error>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="dob" >Date of Birth</label>
                                                <input id="dob" v-model="form.dob" type="date" name="dob" :class="{ 'is-invalid': form.errors.has('dob') }" class="form-control" placeholder="Date of birth">
                                                <has-error :form="form" field="dob"></has-error>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="phone" >Phone</label>
                                                <input id="phone" v-model="form.phone" type="text" name="phone" :class="{ 'is-invalid': form.errors.has('phone') }" class="form-control" placeholder="Phone">
                                                <has-error :form="form" field="phone"></has-error>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="city" >City</label>
                                                <input id="city" v-model="form.city" type="text" name="city" :class="{ 'is-invalid': form.errors.has('city') }" class="form-control" placeholder="City">
                                                <has-error :form="form" field="city"></has-error>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="zip_code" >Zip Code</label>
                                                <input id="zip_code" v-model="form.zip_code" type="text" name="zip_code" :class="{ 'is-invalid': form.errors.has('zip_code') }" class="form-control" placeholder="Zip Code">
                                                <has-error :form="form" field="zip_code"></has-error>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="country" >Country</label>
                                                <input id="country" v-model="form.country" type="text" name="country" :class="{ 'is-invalid': form.errors.has('country') }" class="form-control" placeholder="Country">
                                                <has-error :form="form" field="country"></has-error>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="postal_address" >Address</label>
                                            <textarea id="postal_address" v-model="form.postal_address" name="postal_address" :class="{ 'is-invalid': form.errors.has('postal_address') }" class="form-control" placeholder="Address"></textarea>
                                            <has-error :form="form" field="postal_address"></has-error>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="avatar">
                                        <label for="avatar" >User Avatar</label>
                                        <input class="form-control dropify" id="avatar" data-allowed-file-extensions="png jpg" type="file" name="avatar" :data-default-file="form.avatar"  data-height="250">
                                        <small class="text-info">* Banner height should be 1920 * 1080 px. </small>
                                        <div class="alert pt-2 p-0 mb-0" role="alert" style="display:none;">
                                            <span class="error d-inline-block text-rose"></span>
                                            <span class="close" aria-hidden="true" data-toggle="tooltip" data-placement="middle" title="close">&times;</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="form-control btn btn-primary align-text-top mt-0" :disabled="disabled">
                                            @{{button_text}}
                                            <span v-if="disabled" v-html="loaderButton"></span>
                                        </button>
                                    </div>
                                </div>
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
<script src="{{ asset('vendor') }}/dropify/js/dropify.js"></script>
<script>
    $(document).ready(function() {
        // Dropify
        drEvent = $('#profileForm .dropify').dropify();
        drEvent = drEvent.data('dropify');

        //Override form submit
        function submitForm(){
            $("form").on("submit", function (event) {
                console.log($('input[name=id]').val());
                $('.alert').slideUp();
                event.preventDefault();
                app.button_text = 'Updateing ...';
                app.disabled = !app.disabled;
                $.ajax({
                    url: $(this).attr('action'), // Get the action URL to send AJAX to
                    type: "post",
                    data: new FormData(this), // get all form variables
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: (res => {
                        app.button_text = 'Update';
                        app.disabled = !app.disabled;
                        app.$toastr.success(res.message, res.status);
                        app.form.reset();
                    }),
                    error: (err => {
                        app.button_text = 'Update';
                        app.disabled = !app.disabled;
                        errorProcess(err)
                    }),
                })
            });
        }

        submitForm();

        // SHOW RESPECTIVE VALIDATION ERROR MESSAGES
        function errorProcess(xhr){
            if (xhr.status == 422) {
                var errors_obj = JSON.parse(xhr.responseText);
                var errors = errors_obj.errors;
                for (name in errors) {
                    $("[name="+name+"]").siblings('.alert').children('.error').html(errors[name][0]);
                    $("[name="+name+"]").siblings('.alert').slideDown();
                }
            } else {
                app.$toastr.error(xhr.responseJSON.message, xhr.status);
            }
        }

        // VALIDATION MESSAGE CLOSE
        $('.close').on('click', function(e){
            var alert = $(this).parent();
            alert.slideUp();
        })
    });

    const app = new Vue({
        el: '#app',
        data:{
            authUser : '{{auth("admin")->user()->id}}',
            button_text: 'Update',
            loaderButton: '<img src="/box.gif" alt="..." style="width: 30px;">',
            notifications: [],
            form : new Form({
                id: '',
                fname : '',
                lname : '',
                email : '',
                phone : '',
                postal_address : '',
                city : '',
                zip_code : '',
                country : '',
                dob : '',
                avatar : '{{asset("storage/backend/default/user.png")}}',
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
            getUser(id){
                axios.post('{{route("admin.users.get")}}',{id: id})
                    .then(res=>{
                        this.form.fill(res.data);
                        this.$nextTick(function () {
                            drEvent.resetPreview();
                            drEvent.clearElement();
                            drEvent.settings.defaultFile = this.form.avatar;
                            drEvent.destroy();
                            drEvent.init();
                            drEvent =$('#profileForm .dropify').dropify({
                                defaultFile: this.form.avatar,
                            });
                            drEvent = drEvent.data('dropify');
                        });
                    })
                    .catch(e=>{
                        alert(e);
                    })
            },
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
            attachFile(event)
            {
                this.form.avatar = event.target.files[0];
            },
            updateProfile(){
                this.form.post('{{route("admin.profile.update")}}')
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
        mounted(){

            this.getUser(this.authUser);
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
