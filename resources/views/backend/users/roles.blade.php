@extends('backend.layouts.app', ['activePage' => 'users.panel', 'title' => 'User Roles'])

@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('material')}}/plugins/DataTables/media/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="{{asset('material')}}/plugins/DataTables/media/css/dataTables.bootstrap.css">
@endpush

@section('content')
<div class="main-panel" id="app">
    {{-- Navbar Section --}}
    @include('backend.layouts.navbars.navs.auth', ['title' => 'User Roles'])
    {{-- // Navbar Section --}}

    <main class="content">
        <div class="container-fluid">
            <div class="card mb-0">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-header card-header-warning">
                            <h4 class="card-title">User Roles</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-8 col-xl-8 col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex no-block align-items-center m-b-10">
                                                <h4 class="card-title">All Roles</h4>
                                            </div>
                                            <div class="">
                                                <table id="data_table" class="table table-bordered nowrap display">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Role Name</th>
                                                            <th>Edit</th>
                                                            <th>Delete</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Column -->
                                <!-- Column -->
                                <div class="col-lg-4 col-xl-4 col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex no-block align-items-center m-b-10">
                                                <h4 v-show="!editMode" class="card-title">Create Role</h4>
                                                <h4 v-show="editMode" class="card-title">Edit Role</h4>
                                            </div>
                                            <form @submit.prevent="editMode ? updateRole():saveRole()">
                                                @csrf
                                                <div class="input-group mb-3">
                                                    <input v-model="form.name" type="text" name="name" :class="{ 'is-invalid': form.errors.has('name') }" class="form-control" placeholder="Name">
                                                    <has-error :form="form" field="name"></has-error>
                                                </div>
                                                @if ($errors->has('name'))
                                                    <div class="error text-danger mb-3">{{ $errors->first('name') }}</div>
                                                @endif
                                                <button v-show="disabled"  disabled type="submit" class="btn btn-success btn-block"><i class="ti-save m-r-5"></i> Update</button>
                                                <button v-show="!disabled" type="submit" class="btn btn-success btn-block"><i class="ti-save m-r-5"></i> Save</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex no-block align-items-center m-b-10">
                                                <h4 class="card-title">Assign Role</h4>
                                            </div>
                                            <form @submit.prevent = "assignRole()">
                                                <label for="">Select User</label>
                                                <div class="input-group mb-3">
                                                    <select  v-model="form2.user" name="user" class="form-control" :class="{ 'is-invalid': form2.errors.has('user') }">
                                                        <option v-for='user in users' :key='user.id' :value='user.id'>@{{user.username}}</option>
                                                    </select>
                                                    <has-error :form="form2" field="user"></has-error>
                                                </div>
                                                <label for="">Select Role</label>
                                                <div class="input-group mb-3">
                                                    <select  v-model="form2.role" name="role" class="form-control" :class="{ 'is-invalid': form2.errors.has('role') }">
                                                        <option v-for='role in roles' :key='role.name' :value='role.name'>@{{role.name}}</option>
                                                    </select>
                                                    <has-error :form="form2" field="role"></has-error>
                                                </div>
                                                <button :disabled="form.busy" type="submit" class="btn btn-success btn-block"><i class="ti-save m-r-5"></i> Save</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Column -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
    </main>

    {{-- Footer Section --}}
    @include('backend.layouts.footers.auth')
    {{-- Footer Section --}}
</div>
@endsection


@push('scripts')

{{-- DataTable --}}
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script>
        $(function(){
            getRoles();
        })

        function getRoles(){
            $('#data_table').DataTable({
                    processing: true,
                    serverSide: true,
                    destroy: true,
                    "order": [[ 0, "desc" ]],
                    ajax:  "{{route('admin.roles.datatable')}}",
                    columns: [
                                { data: 'id', name: 'id' },
                                { data: 'name', name: 'name' },
                                { data: 'edit', name: 'edit' },
                                { data: 'delete', name: 'delete' },
                            ],
                    "drawCallback": function( settings ) {
                        $('.edit').click(function(){
                            event.preventDefault()
                            var id = $(this).data("id");
                            var name = $(this).data("name");
                            app.edit(id, name);
                        });
                        $(".delete").click(function() {
                            event.preventDefault();
                            Swal.fire({
                                title: "Are you sure?",
                                text: "You won\'t be able to revert this!",
                                icon: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#3085d6",
                                cancelButtonColor: "#d33",
                                confirmButtonText: "Yes, delete it!"
                                }).then((result) => {
                                if (result.value) {
                                    var id = $(this).data("id");
                                    app.delete(id)
                                }
                            })
                        });
                    }
            });
        }


const app = new Vue({
        el: '#app',

        data:{
            authUser : '{{auth("admin")->user()->id}}',
            notifications: [],
            disabled: false,
            editMode: false,
            users: [],
            roles: [],
            form: new Form({
                    id: '',
                    name: '',
            }),
            form2 : new Form({
                user: '',
                role: ''
            })
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
            saveRole(){
                this.disabled = true;
                this.form.post('{{route("admin.roles.store")}}')
                    .then(res => {
                        this.disabled = false
                        this.form.reset()
                        if(res.data.status == 'Success'){
                            this.$toastr.success(res.data.message, res.data.status);
                        } else {
                            this.$toastr.warning(res.data.message, res.data.status);
                        }
                        getRoles()
                        this.getRolesName()
                    })
                    .catch(e=>{
                        this.disabled = true;
                        this.disabled = false
                    })
            },
            edit(id, name){
                this.editMode = true;
                this.form.id = id
                this.form.name = name
            },
            updateRole(){
                this.disabled = true;
                this.form.put(`/admin/roles/${this.form.id}`)
                    .then(res=>{
                        this.form.reset()
                        this.disabled = false;
                        this.editMode = false;
                        if(res.data.status == 'Success'){
                            this.$toastr.success(res.data.message, res.data.status);
                        } else {
                            this.$toastr.warning(res.data.message, res.data.status);
                        }
                        getRoles()
                        this.getRolesName()
                    })
                    .catch(e=>{
                        alert(e);
                        this.disabled = false;
                        // this.editMode = false;
                    })
            },
            delete(id){
                this.form.delete(`/admin/roles/${id}`)
                    .then(res=>{
                        if(res.data.status == 'Success'){
                            this.$toastr.success(res.data.message, res.data.status);
                        } else {
                            this.$toastr.warning(res.data.message, res.data.status);
                        }
                        getRoles();
                        this.getRolesName()
                    })
                    .catch(e=>{
                        alert(e);
                    })
            },
            getUsers(){
                axios.get("{{route('admin.users')}}")
                    .then(res=>{
                        this.users = res.data
                    })
                    .catch(e=>{
                        alert(e)
                    })
            },
            getRolesName(){
                axios.get("{{route('admin.roles')}}")
                    .then(res=>{
                       this.roles = res.data
                    })
                    .catch(e=>{
                        alert(e)
                    })
            },
            assignRole(){
                this.form2.post('admin.roles.assignRole')
                    .then(res=>{
                        if(res.data.status == 'Success'){
                            this.$toastr.success(res.data.message, res.data.status);
                        } else {
                            this.$toastr.warning(res.data.message, res.data.status);
                        }
                        this.form2.reset();
                    })
                    .catch(e=>{
                        alert(e)
                    })
            }
        },
        mounted(){
            this.getUsers()
            this.getRolesName()
        }
    });

</script>
@endpush
