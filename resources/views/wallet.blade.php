@extends('layouts.app')

@section('content')
    <div id="app" class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-user">
                    <div class="card-header">
                        <h5 class="title">Request Top-Up</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <form method="POST" action="{{ route('wallet.pay') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label>Amount</label>
                                            <input name="amount" type="number" class="form-control">
                                        </div>
                                        <div class="form-group">

                                        </div>
                                        <button class="btn btn-primary btn-block">Send Request</button>
                                    </form>
                                </div>
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
        const e = new Vue({
            el: '#app',
            mounted() {
            }
        });
    </script>
@endsection
