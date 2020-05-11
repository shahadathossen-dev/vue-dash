@extends('backend.layouts.app', ['activePage' => 'company.settings', 'title' => "Company Settings"])

@section('title')
    Company Settings
@endsection

@push('styles')
    <link href="{{asset('vendor')}}/dropify/css/dropify.css" rel="stylesheet">
@endpush


@section('content')
<div class="main-panel" id="app">
    {{-- Navbar Section --}}
    @include('backend.layouts.navbars.navs.auth', ['title' => 'About Us'])
    {{-- // Navbar Section --}}

    <main class="content">
        <div class="container-fluid" id="comapny-settings">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-0">
                        <div class="card-header card-header-warning">
                            <h4 class="card-title">Company Settings</h4>
                        </div>
                        <div class="card-body">
                            <form id="contactForm" action="{{route('company.settings.update')}}" method="POST" enctype="multipart/form-data">
                                <input type="hidden" v-model="form.id" name="id">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="company_name">Company Name</label>
                                                    <input v-model="form.company_name" id="company_name" type="text" name="company_name" :class="{ 'is-invalid': form.errors.has('company_name') }" class="form-control" placeholder="Company Name">
                                                    <div class="alert pt-2 p-0 mb-0" style="display:none;" role="alert">
                                                        <span class="error d-inline-block text-rose"></span>
                                                        <span class="close" aria-hidden="true" data-toggle="tooltip" data-placement="middle" title="close">&times;</span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="invoice_prefix">Invoice Prefix</label>
                                                    <input v-model="form.invoice_prefix" id="invoice_prefix" type="text" name="invoice_prefix" :class="{ 'is-invalid': form.errors.has('invoice_prefix') }" class="form-control" placeholder="Invoice Prefix ">
                                                    <div class="alert pt-2 p-0 mb-0" style="display:none;" role="alert">
                                                        <span class="error d-inline-block text-rose"></span>
                                                        <span class="close" aria-hidden="true" data-toggle="tooltip" data-placement="middle" title="close">&times;</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6" style="margin: auto">
                                                <div class="">
                                                    <label for="logo">Background Image</label>
                                                    <input class="form-control dropify" id="logo" data-allowed-file-extensions="png jpg" type="file" name="logo" :data-default-file="form.logo" data-height="90">
                                                    <small class="text-info">* Logo height should be 475 * 160 px. </small>
                                                    <div class="alert pt-2 p-0 mb-0" role="alert" style="display:none;">
                                                        <span class="error d-inline-block text-rose"></span>
                                                        <span class="close" aria-hidden="true" data-toggle="tooltip" data-placement="middle" title="close">&times;</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="phone">Phone</label>
                                                    <input v-model="form.phone" id="phone" type="text" name="phone" :class="{ 'is-invalid': form.errors.has('phone') }" class="form-control" placeholder="Phone ">
                                                    <div class="alert pt-2 p-0 mb-0" style="display:none;" role="alert">
                                                        <span class="error d-inline-block text-rose"></span>
                                                        <span class="close" aria-hidden="true" data-toggle="tooltip" data-placement="middle" title="close">&times;</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="city">City</label>
                                                    <input v-model="form.city" id="city" type="text" name="city" :class="{ 'is-invalid': form.errors.has('city') }" class="form-control" placeholder="City ">
                                                    <div class="alert pt-2 p-0 mb-0" style="display:none;" role="alert">
                                                        <span class="error d-inline-block text-rose"></span>
                                                        <span class="close" aria-hidden="true" data-toggle="tooltip" data-placement="middle" title="close">&times;</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="zip_code">Zip Code</label>
                                                    <input v-model="form.zip_code" id="zip_code" type="text" name="zip_code" :class="{ 'is-invalid': form.errors.has('zip_code') }" class="form-control" placeholder="Zip Code ">
                                                    <div class="alert pt-2 p-0 mb-0" style="display:none;" role="alert">
                                                        <span class="error d-inline-block text-rose"></span>
                                                        <span class="close" aria-hidden="true" data-toggle="tooltip" data-placement="middle" title="close">&times;</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="country">Country</label>
                                                    <input v-model="form.country" id="country" type="text" name="country" :class="{ 'is-invalid': form.errors.has('country') }" class="form-control" placeholder="Country ">
                                                    <div class="alert pt-2 p-0 mb-0" style="display:none;" role="alert">
                                                        <span class="error d-inline-block text-rose"></span>
                                                        <span class="close" aria-hidden="true" data-toggle="tooltip" data-placement="middle" title="close">&times;</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="postal_address">Postal Address</label>
                                                    <input v-model="form.postal_address" id="postal_address" type="text" name="postal_address" :class="{ 'is-invalid': form.errors.has('postal_address') }" class="form-control" placeholder="Post Address">
                                                    <div class="alert pt-2 p-0 mb-0" style="display:none;" role="alert">
                                                        <span class="error d-inline-block text-rose"></span>
                                                        <span class="close" aria-hidden="true" data-toggle="tooltip" data-placement="middle" title="close">&times;</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="mail_from_email">Mail From Email</label>
                                                    <input v-model="form.mail_from_email" id="mail_from_email" type="email" name="mail_from_email" :class="{ 'is-invalid': form.errors.has('mail_from_email') }" class="form-control" placeholder="support@example.com">
                                                    <div class="alert pt-2 p-0 mb-0" style="display:none;" role="alert">
                                                        <span class="error d-inline-block text-rose"></span>
                                                        <span class="close" aria-hidden="true" data-toggle="tooltip" data-placement="middle" title="close">&times;</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="mail_from_name">Mail From Name</label>
                                                    <input v-model="form.mail_from_name" id="mail_from_name" type="text" name="mail_from_name" :class="{ 'is-invalid': form.errors.has('mail_from_name') }" class="form-control" placeholder="John Doe">
                                                    <div class="alert pt-2 p-0 mb-0" style="display:none;" role="alert">
                                                        <span class="error d-inline-block text-rose"></span>
                                                        <span class="close" aria-hidden="true" data-toggle="tooltip" data-placement="middle" title="close">&times;</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="test_mail_address">Test Mail Address</label>
                                                    <input v-model="form.test_mail_address" id="test_mail_address" type="email" name="test_mail_address" :class="{ 'is-invalid': form.errors.has('test_mail_address') }" class="form-control" placeholder="example@example.com">
                                                    <div class="alert pt-2 p-0 mb-0" style="display:none;" role="alert">
                                                        <span class="error d-inline-block text-rose"></span>
                                                        <span class="close" aria-hidden="true" data-toggle="tooltip" data-placement="middle" title="close">&times;</span>
                                                    </div>
                                                </div>
                                                <div class="form-group pb-0">
                                                    <label for="test_mail" class="">Send Test Mail</label>
                                                    <input v-model="form.test_mail" id="test_mail" type="checkbox" name="test_mail" :class="{ 'is-invalid': form.errors.has('test_mail') }" class="" value="1">
                                                    <div class="alert pt-2 p-0 mb-0" style="display:none;" role="alert">
                                                        <span class="error d-inline-block text-rose"></span>
                                                        <span class="close" aria-hidden="true" data-toggle="tooltip" data-placement="middle" title="close">&times;</span>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="default_company" class="">Default Company</label>
                                                    <input v-model="form.default_company" id="default_company" type="checkbox" name="default_company" :class="{ 'is-invalid': form.errors.has('default_company') }" class="" value="1">
                                                    <div class="alert pt-2 p-0 mb-0" style="display:none;" role="alert">
                                                        <span class="error d-inline-block text-rose"></span>
                                                        <span class="close" aria-hidden="true" data-toggle="tooltip" data-placement="middle" title="close">&times;</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="">
                                                    <label for="icon">Fav Icon</label>
                                                    <input class="form-control dropify" id="icon" data-allowed-file-extensions="png jpg" type="file" name="icon" :data-default-file="form.icon" data-height="90">
                                                    <small class="text-info">* Icon height should be 16 * 16 px. </small>
                                                    <div class="alert pt-2 p-0 mb-0" role="alert" style="display:none;">
                                                        <span class="error d-inline-block text-rose"></span>
                                                        <span class="close" aria-hidden="true" data-toggle="tooltip" data-placement="middle" title="close">&times;</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="bank_details">Bank Details</label>
                                                    <textarea v-model="form.bank_details" id="bank_details" type="text" name="bank_details" :class="{ 'is-invalid': form.errors.has('bank_details') }" class="form-control" placeholder="Bank Details" rows="4"></textarea>
                                                    <div class="alert pt-2 p-0 mb-0" style="display:none;" role="alert">
                                                        <span class="error d-inline-block text-rose"></span>
                                                        <span class="close" aria-hidden="true" data-toggle="tooltip" data-placement="middle" title="close">&times;</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mt-0">
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
        </div>
    </main>

    {{-- Footer Section --}}
    @include('backend.layouts.footers.auth')
    {{-- Footer Section --}}
</div>

@endsection

@push('scripts')

<script src="{{asset('vendor')}}/dropify/js/dropify.js"></script>

<script>

    // Dropify
    $(document).ready(function() {

        //Override form submit
        function submitContactForm(){
            $("form").on("submit", function (event) {
                event.preventDefault();
                $('.alert').slideUp();
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
                    }),
                    error: (err => {
                        app.button_text = 'Update';
                        app.disabled = !app.disabled;
                        errorProcess(err)
                        // app.$toastr.error(err.responseJSON.message, err.status);
                    }),
                })
                // .done(function(res){
                //     app.$toastr.success(res.message, res.status);

                //     app.button_text = 'Update';
                //     app.disabled = !app.disabled;

                // })
            });
        }

        submitContactForm();

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
            notifications: [],
            button_text: 'Update',
            loaderButton: '<img src="/box.gif" alt="..." style="width: 30px;">',
            form : new Form({
                id : 1,
                company_name : '',
                invoice_prefix : '',
                phone : '',
                city : '',
                zip_code : '',
                country : '',
                postal_address : '',
                mail_from_email : '',
                mail_from_name : '',
                test_mail_address : '',
                test_mail : '',
                default_company : 1,
                bank_details : '',
                logo : '',
                icon : '',
                // logo : "{{asset('frontend')}}/img/logo.png",
                // icon : "{{asset('frontend')}}/img/favicon.png",
            }),
            disabled: false,
        },
        computed: {
            checked() {
                return this.form.default_company;
            }
        },
        filters: {
            dateTime: function (datetime) {
                if (!datetime) {
                    return 'N/A'
                }
                return moment(datetime).format('YYYY-MM-DD HH:mm:ss');
                // return moment(date, 'YYYY-MM-DD').format(format);
            },
            lowercase: function (value) {
                return value.toLowerCase();
            }
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
            attachFile(event)
            {
                this.form.bg = event.target.files[0];
            },
            getSettings(){
                axios.get('{{route("company.getSettings")}}')
                    .then(res=>{
                        let data = res.data;
                        if(data !== null && data !== '') {
                            this.$nextTick(function () {

                                setTimeout(
                                    function(){
                                        $('.dropify').dropify();
                                    }, this.form.fill(res.data)
                                )
                            });
                        } else {
                            $('.dropify').dropify();
                        }
                    })
                    .catch(e=>{
                        alert(e);
                    })
            },
        },
        created(){
            this.getNotifications();
            this.getSettings();
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
