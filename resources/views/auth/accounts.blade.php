@extends('auth.layout.app')

@section('content')
    <!--suppress ALL -->
    <div id="app" class="row">
        <div class="col-md-12 p-0">
            <div class="card card-accent-warning">
                <div class="card-header">
                    User Accounts
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-auto">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('accounts.signup') }}" class="btn btn-success btn-round">
                                    <i class="fa fa-user-plus"></i>&nbsp;&nbsp;New Account
                                </a>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <table id="accounts-table" class="table table-hover" width="100%"></table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script>
        const s = new Vue({
            el: "#app",
            data() {
                return {
                    dt: null
                }
            },
            mounted() {
                var $this = this;

                $this.dt = $('#accounts-table').DataTable({
                    processing: true,
                    serverSide: true,
                    scrollX: true,
                    responsive: true,
                    lengthChange: false,
                    order: [[0, 'desc']],
                    pageLength: 5,
                    ajax: {
                        url: "{{ route('accounts.fetch') }}",
                        method: "POST",
                    },
                    columns: [
                        {data: 'id', name: 'id', title: 'ID'},
                        {
                            data: function (value) {
                                return '<a href="/accounts/edit/' + value.id + '" class="btn btn-sm btn-link">' + value.name + '</a>';
                            }, name: 'name', title: 'Name'
                        },
                        {data: 'role', name: 'role', title: 'Role'},
                        {data: 'status', name: 'status', title: 'Status'},
                        {
                            data: function (value) {
                                return '<a href="/r/p/' + value.id + '" class="btn btn-sm btn-warning">Reset Pass</a>';
                            }, name: 'id', title: 'Reset Pass'
                        },
                    ],
                    drawCallback: function () {
                        $('table .btn').on('click', function () {
                            let data = $(this).parent().parent().parent();
                            let hold = $this.dt.row(data).data();
                            $this.overview = hold;
                            console.log(hold);
                        });
                    }
                });
            }
        })
    </script>
@endsection
