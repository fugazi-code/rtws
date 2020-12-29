@extends('auth.layout.app')

@section('content')
    <!--suppress ALL -->
    <div id="app" class="row">
        <div class="col-md-12">
            <div class="card card-accent-warning">
                <div class="card-header">
                    Request Details
                </div>
                <div class="card-body">
                    <div class="row justify-content-start">
                        <div class="col-auto text-right">
                            <label class="font-weight-bold">Reference No.</label>
                        </div>
                        <div class="col-auto">
                            <label class="text-muted">{{ strtoupper($results->ref_no) }}</label>
                        </div>
                        <div class="col-12">
                            <hr class="m-1">
                        </div>
                        <div class="col-auto text-right">
                            <label class="font-weight-bold">Status</label>
                        </div>
                        <div class="col-auto">
                            <label v-if="results.status == 'pending'" class="mb-0 badge badge-info">Looking for a
                                Rider...</label>
                            <label v-else-if="results.status == 'accepted'" class="mb-0 badge badge-warning">Rider
                                Assigned</label>
                            <label v-else-if="results.status == 'cancelled'" class="mb-0 badge badge-danger">
                                Cancelled</label>
                            <label v-else class="badge badge-success">@{{ results.status }}</label>
                        </div>
                        <div class="col-12">
                            <hr class="m-1">
                        </div>
                        <div class="col-auto text-right pr-0">
                            <label class="font-weight-bold">Amount</label>
                        </div>
                        <div class="col-auto">
                            <label class="text-muted">{{ strtoupper($results->amount) }}</label>
                        </div>
                        @if($results->budget !== null)
                            <div class="col-auto text-right pl-4 pr-0">
                                <label class="font-weight-bold">Budget</label>
                            </div>
                            <div class="col-auto">
                                <label class="text-muted">{{ $results->budget }}</label>
                            </div>
                        @endif
                        @if($results->weight !== null)
                            <div class="col-auto text-right pr-0">
                                <label class="font-weight-bold">Weight</label>
                            </div>
                            <div class="col-auto">
                                <label class="text-muted">{{ $results->weight }}</label>
                            </div>
                        @endif
                        <div class="col-12">
                            <hr class="m-1">
                        </div>
                        <div class="col-auto text-right pr-0">
                            <label class="font-weight-bold">Service</label>
                        </div>
                        <div class="col-auto">
                            <label class="text-muted">{{ strtoupper($results->service) }}</label>
                        </div>
                        <div class="col-auto text-right pr-0">
                            <label class="font-weight-bold">Vehicle</label>
                        </div>
                        <div class="col-auto">
                            <label class="text-muted">{{ strtoupper($results->vehicle) }}</label>
                        </div>
                        <div class="col-12">
                            <hr class="m-1">
                        </div>
                        <div class="col-auto text-right">
                            <label class="font-weight-bold">Schedule</label>
                        </div>
                        <div class="col-auto">
                            <label class="text-muted">{{ strtoupper($results->schedule) }}</label>
                        </div>
                        <div class="col-auto text-right">
                            <label class="font-weight-bold">Distance</label>
                        </div>
                        <div class="col-auto">
                            <label class="text-muted">{{ strtoupper($results->distance) }}</label>
                        </div>
                        <div class="col-12">
                            <hr class="m-1">
                        </div>
                        <div class="col-auto text-right">
                            <label class="font-weight-bold">Rider</label>
                        </div>
                        <div class="col-auto">
                            <label class="text-muted">{{ strtoupper($results->rider_name) }}</label>
                        </div>
                        <div class="col-12">
                            <hr class="m-1">
                        </div>
                        <div class="col-auto text-right">
                            <label class="font-weight-bold">Pick Up</label>
                        </div>
                        <div class="col-auto">
                            <label class="text-muted">{{ strtoupper($results->pick_up) }}</label>
                        </div>
                        <div class="col-auto text-right">
                            <label class="font-weight-bold">Drop Off</label>
                        </div>
                        <div class="col-auto">
                            <label class="text-muted">{{ strtoupper($results->drop_off) }}</label>
                        </div>
                        <div class="col-12 mt-2">
                        <a href="{{ route('request.status') }}" class="btn btn-block btn-square btn-info text-white">
                            Back
                        </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const e = new Vue({
            el: '#app',
            data: {
                fetchid: '{{ auth()->id() }}',
                books: [],
                results: {!! collect($results) !!}
            },
            methods: {
                fetch() {
                }
            },
            mounted() {
            }
        })
    </script>
@endsection
