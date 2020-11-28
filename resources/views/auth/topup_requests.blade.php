@extends('auth.layout.app')

@section('content')
    <!--suppress ALL -->
    <div id="app" class="row">
        <div class="col-md-12">
            <div class="card card-accent-warning">
                <div class="card-header">
                    Top Up Requests
                </div>
                <div class="card-body">
                    <div class="row">
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
                        url: "{{ route('topup.table') }}",
                        method: "POST",
                    },
                    columns: [
                        {data: 'id', name: 'id', title: 'ID'},
                        {
                            data: function (value) {
                                return '<a href="/topup/edit/' + value.id + '" class="btn btn-link">' + value.status + '</a>'
                            }, name: 'status', title: 'Status'
                        },
                        {data: 'amount', name: 'amount', title: 'Amount'},
                        {
                            data: function (value) {
                                if (value.requestor != null) {
                                    return value.requestor.name
                                }
                                return "N/A"
                            }, name: 'requestor.name', title: 'Request By'
                        },
                        {
                            data: function (value) {
                                return '<ul id="imgl-' + value.id + '" class="lightgallery list-unstyled row"' +
                                    'style="margin-top: -3px; margin-bottom: -1rem;">' +
                                    '<li class="col-xs-6 col-sm-4 col-md-3" data-src="/storage/' + value.receipt + '">' +
                                    '<a href=""  class="btn btn-sm btn-square btn-info">' +
                                    'View' +
                                    '</a>' +
                                    '</li>' +
                                    '</ul>'
                            }, name: 'receipt', title: 'Receipt'
                        },
                        {
                            data: function (value) {
                                if (value.approver != null) {
                                    return value.approver.name
                                }
                                return "N/A"
                            }, name: 'approver.name', title: 'Approver'
                        },
                        {data: 'created_at', name: 'created_at', title: 'Created At'},
                    ],
                    drawCallback: function () {
                        $('table .btn').on('click', function () {
                            let data = $(this).parent().parent().parent();
                            let hold = $this.dt.row(data).data();
                            $this.overview = hold;
                            console.log(hold);
                        });

                        $('.lightgallery').each(function (e, val) {
                            $('#' + val.id).lightGallery();
                        });
                    }
                });
            }
        })
    </script>
@endsection
