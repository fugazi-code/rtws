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
                                    <h1 class="display-3 text-center">0.00</h1>
                                    <p class="lead text-center"><a href="#" class="btn btn-primary">Request Top-up</a></p>
                                </div>
                            </div>
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
            }
        })
    </script>
@endsection
