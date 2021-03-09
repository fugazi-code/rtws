@extends('auth.layout.app')

@section('content')
    <!--suppress ALL -->
    <div id="app" class="row">
        <div class="col-md-12 p-0">
            <div class="card card-accent-warning">
                <div class="card-header">
                    Promo Codes
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 pr-0 pl-0">
                            <div class="input-group">
                                <input type="number" class="form-control" placeholder="Discount"
                                       v-model="overview.discount">
                                <div class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 pr-0">
                            <div class="input-group">
                                <input type="number" class="form-control" placeholder="Uses" v-model="overview.overall">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="fa fa-users"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 pl-0 pr-0 mt-2">
                            <input type="date" class="form-control" placeholder="Exp. Date"
                                   v-model="overview.expiration">
                        </div>
                        <div class="col-6 pr-0 mt-2">
                            <button class="btn btn-block btn-success btn-square shadow-sm" @click="generate">Generate
                            </button>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 overflow-auto pl-0 pr-0">
                            <table id="codes-table" class="table table-hover table-bordered"
                                   style="width: 100%"></table>
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
        const e = new Vue({
            el: '#app',
            data: {
                promo_codes: [],
                overview: {
                    id: null,
                    discount: null,
                    expiration: null,
                    overall: null,
                }
            },
            methods: {
                remove: function (id) {
                    var $this = this;
                    $.ajax({
                        url: '{{ route('code.remove') }}',
                        method: 'POST',
                        data: {id: id},
                        success: function (value) {
                            swal('Success!', 'New Promo Code has been removed.', 'success')
                            $this.dt.draw();
                        }
                    });
                },
                generate: function () {
                    var $this = this;
                    if ($this.discount === null) {
                        swal('Please try again!', 'No Discount indicated.', 'error');
                        return false;
                    }
                    $.ajax({
                        url: '{{ route('code.generate') }}',
                        method: 'POST',
                        data: $this.overview,
                        success: function (value) {
                            $this.discount = null;
                            swal('Success!', 'New Promo Code has been created.', 'success')
                            $this.dt.draw();
                        }
                    });
                },
            },
            mounted() {
                var $this = this;
                $this.dt = $('#codes-table').DataTable({
                    processing: true,
                    serverSide: true,
                    scrollX: true,
                    responsive: true,
                    "bLengthChange": false,
                    "bFilter": true,
                    "bInfo": false,
                    "bAutoWidth": false,
                    order: [[0, 'desc']],
                    ajax: {
                        url: '{{ route('code.fetch') }}',
                        method: "POST",
                    },
                    columns: [
                        {data: 'code', name: 'code', title: '<i class="fa fa-code"></i>'},
                        {data: 'discount', name: 'discount', title: '<i class="fa fa-percent"></i>'},
                        {data: function (value) {
                                return value.used + '/' + value.overall;
                            }, name: 'overall', title: '<i class="fa fa-chart-pie"></i>'},
                        {data: 'expiration', name: 'expiration', title: '<i class="fa fa-calendar-times"></i>'},
                        {
                            data: function (value) {
                                return '<button type="button" class="btn btn-sm btn-danger btn-remove">' +
                                    '<i class="fa fa-trash"></i>' +
                                    '</button>'
                            }, name: 'id', title: '<i class="fa fa-cogs"></i>'
                        },
                    ],
                    drawCallback: function () {
                        $('table .btn').on('click', function () {
                            let data = $(this).parent().parent();
                            let hold = $this.dt.row(data).data();
                            $this.overview = hold;
                            console.log(hold);
                        });

                        $('table .btn-remove').on('click', function () {
                            $this.remove($this.overview.id)
                        });
                    }
                });
            }
        })
    </script>
@endsection
