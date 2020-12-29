@extends('auth.layout.app')

@section('content')
    <!--suppress ALL -->
    <div id="app" class="row">
        <div class="col-md-12">
            <div class="card card-accent-warning">
                <div class="card-header">
                    Request Status
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            @canany(['admin', 'superadmin'])
                                <div class="col-md-auto mb-3">
                                    <form>
                                        <label>Override ID:</label>
                                        <input class="form-control" v-model="fetchid" @keyup="fetch()">
                                    </form>
                                </div>
                            @endcan
                        </div>
                        <div class="col-md-12 mb-3 border p-1 shadow-sm" v-for="book in books" :key="book._id">
                            <div class="row">
                                <!-- =============================== -->
                                <div class="col-auto align-self-start pr-0">
                                    <a v-bind:href="book.id" class="text-black-50">
                                        Ref no. @{{ book.ref_no }} <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                                <div class="col align-self-center">
                                    <h6 v-if="book.status == 'pending'" class="mb-0 badge badge-info">Looking for a
                                        Rider...</h6>
                                    <h6 v-else-if="book.status == 'accepted'" class="mb-0 badge badge-warning">Rider
                                        Assigned</h6>
                                    <h6 v-else-if="book.status == 'cancelled'" class="mb-0 badge badge-danger">
                                        Cancelled</h6>
                                    <h6 v-else class="badge badge-success">@{{ book.status }}</h6>
                                </div>
                                <div class="mb-0 col-auto align-self-end">Php @{{ book.amount }}</div>
                                <!-- =============================== -->
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-4 font-weight-bold text-right pr-0">Schedule</div>
                                        <div class="col-auto">@{{ book.schedule }}</div>
                                    </div>
                                </div>
                                <!-- =============================== -->
                                <div class="col-12" v-if="book.rider">
                                    <div class="row">
                                        <div class="col-4 font-weight-bold text-right pr-0">Rider</div>
                                        <div class="col-auto">
                                            <a :href="book.rider.msg_link" target="_blank" class="text-black-50">
                                                @{{ book.rider.name }}
                                                <i class="fas fa-link"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- =============================== -->
                                <div class="col-12" v-if="book.rider">
                                    <div class="row">
                                        <div class="col-4 font-weight-bold text-right pr-0">Contact</div>
                                        <div class="col-auto"><small>@{{ book.rider.contact }}</small></div>
                                    </div>
                                </div>
                                <!-- =============================== -->
                                <div class="col-12" v-if="book.pick_up">
                                    <div class="row">
                                        <div class="col-auto font-weight-bold text-right pr-0">Pick-Up</div>
                                        <div class="col-auto"><small>@{{ book.pick_up }}</small></div>
                                    </div>
                                </div>
                                <div class="col-12" v-if="book.drop_off">
                                    <div class="row">
                                        <div class="col-auto font-weight-bold text-right pr-0">Drop-Off</div>
                                        <div class="col-auto"><small>@{{ book.drop_off }}</small></div>
                                    </div>
                                </div>
                                <!-- =============================== -->
                                <div class="col-12 mt-2">
                                    <div class="row justify-content-center">
                                        <div class="col-12">
                                            <form method="POST" action="{{ route('request.cancel') }}">
                                                @csrf
                                                <p class="mb-1" v-if="book.status == 'pending'">
                                                    <input name="book_id" v-bind:value="book.id" hidden>
                                                    <button class="btn btn-block btn-sm btn-square btn-danger card-link">Cancel
                                                        Order
                                                    </button>
                                                </p>
                                            </form>
                                        </div>
                                    </div>
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
    <script>
        const e = new Vue({
            el: '#app',
            data: {
                fetchid: '{{ auth()->id() }}',
                books: []
            },
            methods: {
                fetch() {
                    var $this = this;
                    $.ajax({
                        url: '{{ route('request.fetch') }}',
                        method: 'POST',
                        data: {
                            id: $this.fetchid
                        },
                        success(value) {
                            $this.books = value.booking.data;
                        }
                    })
                }
            },
            mounted() {
                var $this = this;
                const uuid = PubNub.generateUUID();
                this.fetch();
                Echo.channel('booking-status')
                    .listen('BookingStatusEvent', (e) => {
                        console.log(e.update);
                        $this.fetch();
                    });
            }
        })
    </script>
@endsection
