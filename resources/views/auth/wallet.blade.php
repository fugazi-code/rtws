@extends('auth.layout.app')

@section('content')
    <!--suppress ALL -->
    <div id="app" class="row">
        <div class="col-md-12">
            <div class="card card-accent-warning">
                <div class="card-header">
                    Wallet
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="jumbotron jumbotron-fluid">
                                <div class="container">
                                    <h1 class="display-3 text-center">{{ $current }}</h1>
                                    <p class="lead text-center">
                                        <a href="{{ route('wallet.top-up') }}"
                                           class="btn btn-primary btn-square">
                                            Request Top-up
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12"></div>
                        <div class="col-md-12">
                            <table id="top-up-table" class="table table-bordered" width="100%" nowrap></table>
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

                $this.dt = $('#top-up-table').DataTable({
                    processing: true,
                    serverSide: true,
                    scrollX: true,
                    responsive: true,
                    lengthChange: false,
                    order: [[3, 'desc']],
                    pageLength: 5,
                    ajax: {
                        url: "{{ route('wallet.table') }}",
                        method: "POST",
                    },
                    columns: [
                        {data: 'status', name: 'status', title: 'Status'},
                        {data: 'amount', name: 'amount', title: 'Amount'},
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
                            }, name: 'approver.name', title: 'Approved By'
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
