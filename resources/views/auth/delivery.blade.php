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
                                <div class="col-12 mb-3">
                                    <form>
                                        <label>Override ID:</label>
                                        <input class="form-control" v-model="fetchid" @keyup="fetch()">
                                    </form>
                                </div>
                            @endcan
                            <div class="col-12 mb-2 p-0">
                                <div class="btn-group w-100" role="group">
                                    <button type="button" class="btn btn-square" @click="windowpanel = 1"
                                            v-bind:class="{ 'btn-primary': (windowpanel == 1), 'btn-dark': (windowpanel != 1) }">
                                        Available
                                    </button>
                                    <button type="button" class="btn" @click="windowpanel = 2"
                                            v-bind:class="{ 'btn-primary': (windowpanel == 2), 'btn-dark': (windowpanel != 2) }">
                                        Yours
                                    </button>
                                    <button type="button" class="btn" @click="windowpanel = 3"
                                            v-bind:class="{ 'btn-primary': (windowpanel == 3), 'btn-dark': (windowpanel != 3) }">
                                        Completed
                                    </button>
                                    <button type="button" class="btn btn-square" @click="windowpanel = 4"
                                            v-bind:class="{ 'btn-primary': (windowpanel == 4), 'btn-dark': (windowpanel != 4) }">
                                        Cancelled
                                    </button>
                                </div>
                            </div>
                            {{--                                Available--}}
                            <div class="col-12" v-show="windowpanel == 1">
                                <div class="row mt-2 border shadow-sm pt-2" v-for="delivery in pending">
                                    <div class="col-3">
                                        <div class="row">
                                            <div class="col-12 p-1">
                                                <img v-if="delivery.photo"
                                                     v-bind:src="'/storage/' + delivery.photo.path"
                                                     class="rounded-circle img-fluid">
                                            </div>
                                            <div class="col-12 p-0 text-center">
                                                <label class="badge badge-info text-white">
                                                    @{{ delivery.service }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-9 pl-0">
                                        <div class="row">
                                            <div class="col-auto pr-0">
                                                <a v-bind:href="delivery.customer.msg_link" target="_blank">
                                                    @{{ delivery.customer.name }} <i class="fas fa-link"></i>
                                                </a>
                                            </div>
                                            <div class="col-auto pr-0">
                                                Php @{{ delivery.amount }}
                                            </div>
                                            <div class="col-12">
                                                @{{ delivery.customer.contact}}
                                            </div>
                                            <div class="col-12">
                                                @{{ delivery.schedule }}
                                            </div>
                                            <div class="col-auto" v-if="delivery.budget !== null">
                                                <strong>Budget:</strong> @{{ delivery.budget }}
                                            </div>
                                            <div class="col-auto" v-if="delivery.weight !== null">
                                                <strong>Weight:</strong> @{{ delivery.weight }}
                                            </div>
                                            <div class="col-12">
                                                <strong>Pick-up:</strong> @{{ delivery.pick_up }}
                                            </div>
                                            <div class="col-12">
                                                <strong>Drop-Off:</strong> @{{ delivery.drop_off }}
                                            </div>
                                        </div>
                                    </div>
                                    @if(!\App\Booking::limitBooking(auth()->id()))
                                        <div class="col-12 p-0">
                                            <a v-bind:href="'/d/m/' + delivery.id"
                                               class="btn btn-info btn-block btn-square">
                                                <i class="fas fa-bullseye"></i> Mine
                                            </a>
                                        </div>
                                    @endif
                                </div>
                                <div class="row mt-3 justify-content-center" v-if="pending.length == 0">
                                    <div class="col-auto">
                                        <h3>No Bookings Available.</h3>
                                    </div>
                                </div>
                                @if(\App\Booking::limitBooking(auth()->id()))
                                    <div class="row mt-3 justify-content-center">
                                        <div class="col-auto">
                                            <h5>We only Allow riders 2 bookings at a time.</h5>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            {{--                                    Yours--}}
                            <div class="col-md-12" v-show="windowpanel == 2">
                                <div class="row mt-2 border shadow-sm pt-2" v-for="delivery in yours">
                                    <div class="col-3">
                                        <div class="row">
                                            <div class="col-12 p-1">
                                                <img v-if="delivery.photo"
                                                     v-bind:src="'/storage/' + delivery.photo.path"
                                                     class="rounded-circle img-fluid">
                                            </div>
                                            <div class="col-12 p-0 text-center">
                                                <label class="badge badge-info text-white">
                                                    @{{ delivery.service }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-9 pl-0">
                                        <div class="row">
                                            <div class="col-auto pr-0">
                                                <a v-bind:href="delivery.customer.msg_link" target="_blank">
                                                    @{{ delivery.customer.name }} <i class="fas fa-link"></i>
                                                </a>
                                            </div>
                                            <div class="col-auto pr-0">
                                                Php @{{ delivery.amount }}
                                            </div>
                                            <div class="col-12">
                                                @{{ delivery.customer.contact}}
                                            </div>
                                            <div class="col-12">
                                                @{{ delivery.schedule }}
                                            </div>
                                            <div class="col-auto" v-if="delivery.budget !== null">
                                                <strong>Budget:</strong> @{{ delivery.budget }}
                                            </div>
                                            <div class="col-auto" v-if="delivery.weight !== null">
                                                <strong>Weight:</strong> @{{ delivery.weight }}
                                            </div>
                                            <div class="col-12">
                                                <strong>Pick-up:</strong> @{{ delivery.pick_up }}
                                            </div>
                                            <div class="col-12">
                                                <strong>Drop-Off:</strong> @{{ delivery.drop_off }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 p-0">
                                        <div class="btn-group w-100 mt-2">
                                            <button v-if="role == 'admin' || role == 'superadmin'"
                                                    @click="cancel('/d/cc/' + delivery.id)"
                                                    class="btn btn-danger btn-square btn-block">
                                                <i class="fas fa-ban"></i> Cancel
                                            </button>
                                            <button v-else @click="done('/d/c/' + delivery.id)"
                                                    class="btn btn-success btn-square btn-block">
                                                <i class="fas fa-check"></i> Done
                                            </button>
                                            {{--                                                <button v-if="delivery.validCancel <= 5"--}}
                                            {{--                                                        @click="cancel('/d/cc/' + delivery.id)"--}}
                                            {{--                                                        class="btn btn-danger btn-square">--}}
                                            {{--                                                    <i class="fas fa-ban"></i> Cancel--}}
                                            {{--                                                </button>--}}
                                            {{--                                                <button v-if="delivery.validCancel >= 5"--}}
                                            {{--                                                        class="btn btn-secondary disabled btn-square">--}}
                                            {{--                                                    <i class="fas fa-ban"></i> Cancel--}}
                                            {{--                                                </button>--}}
                                        </div>
                                    </div>
                                    <div class="row mt-3 justify-content-center" v-if="yours.length == 0">
                                        <div class="col-auto">
                                            <h3>You haven't pick a booking.</h3>
                                        </div>
                                    </div>
                                </div>
                                {{--                                    Complete--}}
                                <div class="col-12" v-show="windowpanel == 3">
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
                                {{--                                    Cancelled--}}
                                <div class="col-12" v-show="windowpanel == 4">
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
                        role: '{{ auth()->user()->role }}',
                        pending: {},
                        yours: {},
                        complete: {},
                        cancelled: {},
                        windowpanel: 1
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
                                    this.interval = setInterval(function () {
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
