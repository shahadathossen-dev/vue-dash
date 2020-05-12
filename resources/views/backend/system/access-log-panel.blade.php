@extends('backend.layouts.app', ['activePage' => 'users.panel', 'title' => 'User Activity'])

@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('material')}}/plugins/DataTables/media/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="{{asset('material')}}/plugins/DataTables/media/css/dataTables.bootstrap.css">
@endpush

@section('content')
<div class="main-panel" id="app">
    {{-- Navbar Section --}}
    @include('backend.layouts.navbars.navs.auth', ['title' => 'User Activity'])
    {{-- // Navbar Section --}}
    <main class="content">
        <div class="container-fluid loaded" id="summary">

            <!--Preloader-->
            {{-- @include('backend.layouts.modules.preloader') --}}

            @if(session()->has("success"))
            <div class="alert alert-bordered alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong><i class="fa fa-check-circle"></i> Success!</strong> {{session()->get('success')}}
            </div>
            @endif

            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-warning">
                            <h4 class="card-title">Access Logs Panel</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('system.access-log.index')}}" method="GET">
                                @csrf
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-md-3">
                                                <label for="">Users</label>
                                                <select name="user_id" class="form-control">
                                                    <option value="" selected disabled>All</option>
                                                    <option v-for='user in users' v-bind:value='user.id'> @{{user.username}}</option>
                                                </select>
                                                @error('user_id')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-3">
                                                <label for=""> From Date</label>
                                                <input type='date' id='fromDate' name="from_date" class="form-control" />
                                                @error('from_date')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-3">
                                                <label for=""> To Date</label>
                                                <input type='date' id='toDate' name="to_date" class="form-control" />
                                                @error('to_date')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-3">
                                                <button type="submit" class="btn btn-primary btn-md btn-rounded">Get Logs</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Column -->
            </div>
            <!-- ============================================================== -->
            <!-- End PAge Content -->
            <!-- ============================================================== -->
        </div>
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

// Vue js One page app
    const app = new Vue({
        el: '#summary',
        data:{
            authUser : '{{auth("admin")->user()->id}}',
            notifications: [],
            users:[],
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
            getUsers(){
                axios.get('{{route("admin.users")}}')
                    .then(res=>{
                       this.users = res.data;
                    })
                    .catch(e=>{
                        alert(e);
                    })
            },
        },
        mounted() {
            this.getNotifications()
            this.getUsers();
            $('#summary').addClass('loaded');
        }
    });

</script>
@endpush
