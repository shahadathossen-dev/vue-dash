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
        <div class="container-fluid" id="access_log">

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
                <div class="col-lg-12 col-xl-12 col-md-12">
                    <div class="card">
                        <div class="card-header card-header-warning">
                            <h4 class="card-title">Activity Log</h4>
                        </div>
                        <div class="card-body">
                            <div class="">
                                <table id="data_table" class="table table-bordered table-striped wrap display">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Id</th>
                                            <th>Subject</th>
                                            <th>Date</th>
                                            <th>IP</th>
                                            <th>Action</th>
                                            <th>Status</th>
                                            <th>View</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                @include('backend.system.access-log-modal')
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

    $(function(){
        getUsersLog();
        $('[data-toggle="tooltip"]').tooltip()
    })

    function getUsersLog(){

        $('#data_table').DataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            "order": [[ 0, "desc" ]],
            ajax:  "{{route('system.access-log.datatable')}}",
            columns: [
                        { data: 'id', name: 'id' },
                        { data: 'subject', name: 'subject' },
                        { data: 'created_at', name: 'created_at' },
                        { data: 'user_ip', name: 'user_ip' },
                        { data: 'action', name: 'action' },
                        { data: 'status', name: 'status' },
                        { data: 'view', name: 'view' },
                    ],
            "drawCallback": function( settings ) {
                $('.view').click(function(){
                    var id = $(this).data("id");
                    app.view(id);
                });
            }
        });
    }


const app = new Vue({
        el: '#app',
        data:{
            authUser : '{{auth("admin")->user()->id}}',
            notifications: [],
            log: {user: [], post_data: []},
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
            view(log){
                this.getActivityLog(log)
                $('#access-log-modal').modal('show')
            },
            getActivityLog(log){
                axios.post('{{route("system.access-log.show")}}', {log: log})
                    .then(res=>{
                        this.log = res.data
                        this.log.user = res.data.user
                        this.log.post_data = JSON.parse(res.data.post_data)
                        console.log(this.log.post_data)
                    })
                    .catch(e=>{
                        alert(e);
                    })
            },
            closeModal(){
                $(".result-modal").on('hide.bs.modal', function(){
                    $('.result-modal').addClass('fade')
                }).modal('hide');
            },
        },
        mounted(){
            this.getNotifications()
        }
    });

</script>
@endpush
