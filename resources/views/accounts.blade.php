@extends('layouts.app')

@section('content')
    <div id="app" class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="title">{{ $page_name }}</h5>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="{{ route('accounts.signup') }}" class="btn btn-success btn-round">New Account</a>
                        </div>
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
    </div>
@endsection

@section('scripts')
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
                        {data: 'name', name: 'name', title: 'Name'},
                        {data: 'role', name: 'role', title: 'Role'},
                        {
                            data: function (value) {
                                return '<a href="/accounts/edit/' + value.id + '" class="btn btn-sm btn-info btn-round">Edit</a>';
                            }, name: 'id', title: 'Actions'
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
