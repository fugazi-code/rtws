@extends('auth.layout.app')

@section('content')
    <!--suppress ALL -->
    <div id="app" class="row">
        <div class="col-md-12">
            <div class="card card-accent-warning">
                <div class="card-header">
                    Look for Bookings
                </div>
                <div class="card-body">
                    @if(!\App\Wallet::noFunds())
                        <div class="row">
                            @canany(['admin', 'superadmin'])
                            <div class="col-md-auto mb-3">
                                <form>
                                    <label>Override ID:</label>
                                    <input class="form-control" v-model="fetchid" @keyup="fetch()">
                                </form>
                            </div>
                            @endcan
                            <div class="col-md-12">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="available-tab" data-toggle="tab"
                                           href="#available" role="tab"
                                           aria-controls="home" aria-selected="true">Available</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="yours-tab" data-toggle="tab" href="#yours" role="tab"
                                           aria-controls="profile" aria-selected="false">Yours</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="complete-tab" data-toggle="tab" href="#complete"
                                           role="tab"
                                           aria-controls="messages" aria-selected="false">Completed</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="cancelled-tab" data-toggle="tab" href="#cancelled"
                                           role="tab"
                                           aria-controls="messages" aria-selected="false">Cancelled</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-12">
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    {{--                                Available--}}
                                    <div class="tab-pane active" id="available" role="tabpanel"
                                         aria-labelledby="available-tab">
                                        <div class="row mt-3" v-for="delivery in pending">
                                            <div class="col-4 col-md-2 justify-content-center row">
                                                <div class="col-auto">
                                                    <img v-if="delivery.photo"
                                                         v-bind:src="'/storage/' + delivery.photo.path"
                                                         class="img-fluid">
                                                </div>
                                                <div class="col-auto">
                                                    <label class="badge badge-info text-white">
                                                        <strong>@{{ delivery.service }}</strong>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-8">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <strong>@{{ delivery.customer.name }}</strong>
                                                        @{{ delivery.customer.contact}}
                                                    </div>
                                                    <div class="col-md-12">
                                                        <i>Php @{{ delivery.amount }}</i>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <i>@{{ delivery.schedule }}</i>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <strong>From:</strong> <i>@{{ delivery.pick_up }}</i>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <strong>To:</strong> <i>@{{ delivery.drop_off }}</i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <a v-bind:href="'/d/m/' + delivery.id"
                                                   class="btn btn-info btn-square">
                                                    <i class="fas fa-bullseye"></i> Mine
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row mt-3 justify-content-center" v-if="pending.length == 0">
                                            <div class="col-auto">
                                                <h3>No Bookings Available.</h3>
                                            </div>
                                        </div>
                                    </div>
                                    {{--                                    Yours--}}
                                    <div class="tab-pane" id="yours" role="tabpanel" aria-labelledby="yours-tab">
                                        <div class="row mt-3" v-for="delivery in yours">
                                            <div class="col-4 col-md-2 justify-content-center row">
                                                <div class="col-auto">
                                                    <img v-if="delivery.photo"
                                                         v-bind:src="'/storage/' + delivery.photo.path"
                                                         class="img-fluid">
                                                </div>
                                                <div class="col-auto">
                                                    <label class="badge badge-info text-white">
                                                        <strong>@{{ delivery.service }}</strong>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-8">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <strong>@{{ delivery.customer.name }}</strong>
                                                        @{{ delivery.customer.contact}}
                                                    </div>
                                                    <div class="col-md-12">
                                                        <i>Php @{{ delivery.amount }}</i>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <i>@{{ delivery.schedule }}</i>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <strong>From:</strong> <i>@{{ delivery.pick_up }}</i>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <strong>To:</strong> <i>@{{ delivery.drop_off }}</i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="btn-group-vertical">
                                                    @canany(['admin', 'superadmin'])
                                                        <button @click="cancel('/d/cc/' + delivery.id)"
                                                                class="btn btn-danger btn-square">
                                                            <i class="fas fa-ban"></i> Cancel
                                                        </button>
                                                    @else
                                                        <button @click="done('/d/c/' + delivery.id)"
                                                                class="btn btn-success btn-square">
                                                            <i class="fas fa-check"></i> Done
                                                        </button>
                                                        <button v-if="delivery.validCancel <= 5"
                                                                @click="cancel('/d/cc/' + delivery.id)"
                                                                class="btn btn-danger btn-square">
                                                            <i class="fas fa-ban"></i> Cancel
                                                        </button>
                                                        <button v-if="delivery.validCancel >= 5"
                                                                class="btn btn-secondary disabled btn-square">
                                                            <i class="fas fa-ban"></i> Cancel
                                                        </button>
                                                    @endcan
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3 justify-content-center" v-if="yours.length == 0">
                                            <div class="col-auto">
                                                <h3>You haven't pick a booking.</h3>
                                            </div>
                                        </div>
                                    </div>
                                    {{--                                    complete--}}
                                    <div class="tab-pane" id="complete" role="tabpanel" aria-labelledby="complete-tab">
                                        <div class="row mt-3" v-for="delivery in complete">
                                            <div class="col-4 col-md-2 justify-content-center row">
                                                <div class="col-auto">
                                                    <label class="badge badge-info text-white">
                                                        <strong>@{{ delivery.service }}</strong>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-8">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <i>Php @{{ delivery.amount }}</i>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <i>@{{ delivery.created_at }}</i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--                                    cancelled--}}
                                    <div class="tab-pane" id="cancelled" role="tabpanel"
                                         aria-labelledby="cancelled-tab">
                                        <div class="row mt-3" v-for="delivery in cancelled">
                                            <div class="col-4 col-md-2 justify-content-center row">
                                                <div class="col-auto">
                                                    <label class="badge badge-info text-white">
                                                        <strong>@{{ delivery.service }}</strong>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-8">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <i>Php @{{ delivery.amount }}</i>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <i>@{{ delivery.created_at }}</i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <h4>Please load your <a href="{{ route('wallet') }}">Wallet</a>.</h4>
                    @endif
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
                pending: {},
                yours: {},
                complete: {},
                cancelled: {},
            },
            methods: {
                validatedCancelBtn(dated) {
                    current = new Date();
                    com = new Date(dated);
                    var diff = (com.getTime() - current.getTime()) / 1000;
                    diff /= 60;
                    return Math.abs(Math.round(diff));
                },
                done(link) {
                    swal({
                        title: "Booking will be Completed.",
                        text: "",
                        icon: "info",
                        buttons: true,
                        dangerMode: true,
                    })
                        .then((willDelete) => {
                            if (willDelete) {
                                window.location = link;
                            }
                        });
                },
                cancel(link) {
                    swal({
                        title: "Booking will be Cancelled.",
                        text: "",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                        .then((willDelete) => {
                            if (willDelete) {
                                window.location = link;
                            }
                        });
                },
                fetch() {
                    var $this = this;
                    $.ajax({
                        url: '{{ route('delivery.fetch') }}',
                        method: 'POST',
                        data: {
                          id: $this.fetchid
                        },
                        success: function (value) {
                            $this.pending = value.pending.data;
                            $this.yours = value.yours.data;
                            $this.complete = value.complete.data;
                            $this.cancelled = value.cancelled.data;
                            this.interval = setInterval(function(){
                                $.each($this.yours, (key, value) => {
                                    $this.yours[key].validCancel = $this.validatedCancelBtn(value.updated_at)
                                });
                            }, 1000);
                        }
                    });
                },
            },
            mounted() {
                var $this = this;
                this.fetch();

                Echo.channel('fetch-booking')
                    .listen('BookingSubmitEvent', (e) => {
                        console.log(e.update);
                        $this.fetch();
                    });
            }
        });
    </script>
@endsection
