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
                    <div class="row">
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
                                            <a v-bind:href="'/d/c/' + delivery.id"
                                               class="btn btn-success btn-square">
                                                <i class="fas fa-check"></i> Done
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                {{--                                    complete--}}
                                <div class="tab-pane" id="complete" role="tabpanel" aria-labelledby="complete-tab">
                                    <div class="row mt-3" v-for="delivery in complete">
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
                pending: [],
                yours: [],
                complete: [],
            },
            methods: {
                fetch() {
                    var $this = this;
                    $.ajax({
                        url: '{{ route('delivery.fetch') }}',
                        method: 'POST',
                        success: function (value) {
                            $this.pending = value.pending.data;
                            $this.yours = value.yours.data;
                            $this.complete = value.complete.data;
                        }
                    });
                },
            },
            mounted() {
                var $this = this;
                const uuid = PubNub.generateUUID();
                const pubnub = new PubNub({
                    publishKey: '{{ env('PUB_NUB_PUBLISH_KEY') }}',
                    subscribeKey: '{{ env('PUB_NUB_SUBSCRIBE_KEY') }}',
                    uuid: uuid
                });

                pubnub.subscribe({
                    channels: ['{{ env('PUB_NUB_CHANNEL') }}'],
                    withPresence: true
                });

                pubnub.addListener({
                    message: function (event) {
                        $this.fetch();
                        //console.log(event.message);
                    },
                    presence: function (event) {
                        // console.log(event);
                    }
                });
                this.fetch();
            }
        });
    </script>
@endsection
