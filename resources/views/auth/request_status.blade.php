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
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action" v-for="book in books">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">#@{{ book.ref_no }}
                                    <span v-if="book.status == 'pending'"
                                          class="badge badge-info">Looking for a Rider</span>
                                    <span v-else-if="book.status == 'accepted'" class="badge badge-success">Rider has been assigned</span>
                                    <span v-else-if="book.status == 'cancelled'"
                                          class="badge badge-danger">Cancelled</span>
                                    <span v-else class="badge badge-info">@{{ book.status }}</span>
                                </h5>
                                <small>Php @{{ book.amount }}</small>
                            </div>
                            <p class="mb-1"><strong>Schedule</strong> @{{ book.schedule }}</p>
                            <p v-if="book.rider" class="mb-1"><strong>Rider</strong> @{{ book.rider.name }}
                                (@{{ book.rider.contact }})</p>
                            <p class="mb-1">@{{ book.pick_up }} <strong>to</strong> @{{ book.drop_off }}</p>
                            <form method="POST" action="{{ route('request.cancel') }}">
                                @csrf
                                <p class="mb-1" v-if="book.status == 'pending'">
                                    <input name="book_id" v-bind:value="book.id" hidden>
                                    <button class="btn btn-sm btn-round btn-danger">Cancel Order</button>
                                </p>
                            </form>
                        </a>
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
                books: []
            },
            methods: {
                fetch() {
                    var $this = this;
                    $.ajax({
                        url: '{{ route('request.fetch') }}',
                        method: 'POST',
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
