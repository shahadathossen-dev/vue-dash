@extends('backend.layouts.app', ['activePage' => 'users.panel', 'title' => 'Users'])

@push('styles')
{{-- Dropify --}}
<link rel="stylesheet" href="{{asset('vendor')}}/dropify/css/dropify.css">

{{-- Datatable --}}
<link rel="stylesheet" type="text/css" href="{{asset('material')}}/plugins/DataTables/media/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="{{asset('material')}}/plugins/DataTables/media/css/dataTables.bootstrap.css">

<style>
    .dropify-wrapper .dropify-wrapper {
        position: absolute;
        top: 0px;
        left: 0px;
        min-height: 100%;
    }

    .edit i {
        -webkit-transition: all 0.5s;
        -moz-transition: all 0.5s;
        -ms-transition: all 0.5s;
        -o-transition: all 0.5s;
        transition: all 0.5s;
    }

    .edit .open {
        transform: rotate(90deg);
        -webkit-transform: rotate(90deg);
        -moz-transform: rotate(90deg);
        -o-transform: rotate(90deg);
        -ms-transform: rotate(90deg);
    }

</style>
@endpush

@section('content')

<div class="main-panel" id="app">
    {{-- Navbar Section --}}
    @include('backend.layouts.navbars.navs.auth', ['title' => 'Users'])
    {{-- // Navbar Section --}}
    <main class="content">

        <div class="container-fluid" id='user'>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header card-header-warning">
                            <h4 class="card-title">All Users</h4>
                            <div class="card-tools">
                                <div class="btn-tool">
                                    <button type="button" @click="openUserModal" class="btn btn-success expand">
                                        <small><i class="fa fa-plus"></i></small> Add New User
                                    </button>
                                </div>
                            </div>
                            <p class="card-category"> Users Management</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id='users_table' class="table table-striped table-bordered dataTable" role="grid" aria-describedby="zero_config_info">
                                        <thead class="bg-secondary">
                                            <th>Id</th>
                                            <th >Name</th>
                                            <th >Username</th>
                                            <th >Email</th>
                                            <th  class="text-center" width="">Role</th>
                                            <th  class="text-center" width="">Status</th>
                                            <th  class="text-center d-print-none" width="20%">Delete</th>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Create/Edit Modal --}}
            <div class="modal fade user-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form @submit.prevent="editMode ? updateUser : saveUser">
                            <div class="modal-header">
                                <h5 class="modal-title" id="createModalLabel"><i class="ti-marker-alt m-r-10"></i> Add New User</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input v-model="form.fname" type="text" name="fname" :class="{ 'is-invalid': form.errors.has('fname') }" class="form-control" placeholder="First Name">
                                            <has-error :form="form" field="fname"></has-error>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input v-model="form.lname" type="text" name="lname" :class="{ 'is-invalid': form.errors.has('lname') }" class="form-control" placeholder="Last Name">
                                            <has-error :form="form" field="lname"></has-error>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input v-model="form.username" type="text" name="username" :class="{ 'is-invalid': form.errors.has('username') }" class="form-control" placeholder="Username">
                                            <has-error :form="form" field="username"></has-error>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input v-model="form.email" type="email" name="email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control" placeholder="Email">
                                            <has-error :form="form" field="email"></has-error>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select @cannot('assign roles') disabled @endcan v-model="form.role_id" name="role_id" class="form-control" :class="{ 'is-invalid': form.errors.has('role_id') }">
                                                <option v-for='role in roles' :key='role.id' :value='role.id'>@{{role.name}}</option>
                                            </select>
                                            <has-error :form="form" field="role_id"></has-error>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select @cannot('assign status') disabled @endcan v-model="form.status_id" name="status_id" class="form-control" :class="{ 'is-invalid': form.errors.has('status_id') }">
                                                <option v-for='status in statuses' :key='status.id' :value='status.id'>@{{status.name}}</option>
                                            </select>
                                            <has-error :form="form" field="status_id"></has-error>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input v-model="form.phone" type="text" name="phone" :class="{ 'is-invalid': form.errors.has('phone') }" class="form-control" placeholder="Phone">
                                            <has-error :form="form" field="phone"></has-error>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input v-model="form.dob" type="date" name="dob" :class="{ 'is-invalid': form.errors.has('dob') }" class="form-control" placeholder="Date of birth">
                                            <has-error :form="form" field="dob"></has-error>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success"><i class="ti-save"></i> Save</button>
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
{{-- Dropify --}}
<script src="{{ asset('vendor') }}/dropify/js/dropify.js"></script>

{{-- DataTable --}}
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

<script>

    const app = new Vue({
        el: '#app',
        data:{
            authUser : '{{auth("admin")->user()->id}}',
            isSuperAdmin: '{{auth("admin")->user()->roleIs("Super Admin")}}',
            serial_no: 1,
            loading:false,
            notifications: [],
            statuses: [],
            roles: [],
            editMode: false,
            form: new Form({
                id: '',
                fname: '',
                lname: '',
                username: '',
                email: '',
                role_id: 2,
                status_id: '',
                phone: '',
                dob: '',
            })
        },
        computed: {
            dynamicStatus () {
                return this.isSuperAdmin ? 3 : 2;
            },
        },
        filters: {
            dateTime: function (datetime) {
                if (!datetime) {
                    return 'N/A'
                }
                return moment(datetime).format('YYYY-MM-DD HH:mm:ss');
                // return moment(date, 'YYYY-MM-DD').format(format);
            },
        },
        methods:{
            getRoles(){
                axios.get("{{route('admin.roles')}}")
                    .then(res=>{
                       this.roles = res.data
                    })
                    .catch(e=>{
                        alert(e)
                    })
            },
            getStatuses(){
                axios.get("{{route('admin.statuses')}}")
                    .then(res=>{
                       this.statuses = res.data
                    })
                    .catch(e=>{
                        alert(e)
                    })
            },
            openUserModal(){
                $('.user-modal').modal('show');
            },
            saveUser(){
                this.loading = true;
                this.form.post('{{route("admin.users.store")}}').then(res=> {
                    this.form.reset();
                    this.getUsers();
                    this.$nextTick(function () {
                        $('.user-modal').modal('hide');
                        if(res.data.status == 'Success'){
                            this.$toastr.success(res.data.message, res.data.status);
                        } else {
                            this.$toastr.warning(res.data.message, res.data.status);
                        }
                    });
                })
                .catch(e=>{
                    alert(e);
                    console.log(e);
                })
            },
            editUser(id){
                axios.post('{{route("admin.users.get")}}', {id: id})
                    .then(res=>{
                        this.form.fill(res.data);
                        this.$nextTick(function () {
                            this.openUserModal();
                        });
                    })
                    .catch(e=>{
                        alert(e);
                    })
            },
            updateUser(){
                this.loading = true;
                this.form.post('{{route("admin.users.update")}}').then(res=> {
                    this.form.reset();
                    this.getUsers();
                    this.$nextTick(function () {
                        $('.user-modal').modal('hide');
                        if(res.data.status == 'Success'){
                            this.$toastr.success(res.data.message, res.data.status);
                        } else {
                            this.$toastr.warning(res.data.message, res.data.status);
                        }
                    });
                })
                .catch(e=>{
                    alert(e);
                    console.log(e);
                })
            },
            getUsers(){
                $('#users_table').DataTable({
                    processing: true,
                    serverSide: true,
                    destroy: true,
                    "order": [[ 0, "desc" ]],
                    ajax:  "{{route('admin.users.datatable')}}",
                    columns: [
                                { data: 'id', name: 'id' },
                                { data: 'name', name: 'name' },
                                { data: 'username', name: 'username' },
                                { data: 'email', name: 'email' },
                                { data: 'role', name: 'role' },
                                { data: 'status', name: 'status' },
                                { data: 'actions', name: 'actions' },
                            ],
                    "drawCallback": function( settings ) {
                        $('.edit').click(function(event){
                            event.preventDefault();
                            app.editMode = true;
                            let user = $(this).data('user');
                            app.editUser(user);
                        });
                        $(".delete").click(function() {
                            event.preventDefault();
                            Swal.fire({
                                title: "Are you sure?",
                                text: "You won\'t be able to revert this!",
                                type: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#3085d6",
                                cancelButtonColor: "#d33",
                                confirmButtonText: "Yes, delete it!"
                                }).then((result) => {
                                if (result.value) {
                                    window.location = $(this).attr("href");
                                }
                            })
                        });
                    }
                });
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

        },
        mounted() {
            this.getUsers();
            this.form.status_id = this.dynamicStatus;
        },
        created() {
            // console.log(this.form.status_id)
            this.getStatuses();
            this.getRoles();
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
    });
</script>

@endpush
