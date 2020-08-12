@extends('layouts.app')

@section('content')
    <div id="app" class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-user">
                    <div class="card-header">
                        <h5 class="title">{{ $page_name }}</h5>
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
                                        <div class="table-full-width table-responsive">
                                            <table class="table table-responsive">
                                                <tbody>
                                                <tr v-for="delivery in pending">
                                                    <td class="text-left">
                                                        <div class="row">
                                                            <div class="col-md-12" v-if="delivery.photo">
                                                                <img v-bind:src="'/storage/' + delivery.photo.path"
                                                                     class="avatar border-gray delivery-photo">
                                                            </div>
                                                            <div class="col-md-12 row justify-content-center">
                                                                <div class="col-md-auto">
                                                                    @{{ delivery.customer.name }}
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 row justify-content-center">
                                                                <div class="col-md-auto">
                                                                    @{{ delivery.customer.contact}}
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 row justify-content-center">
                                                                <div class="col-md-auto">
                                                                    <label class="badge badge-info  text-white">
                                                                        <strong>@{{ delivery.service }}</strong>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-left">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <i>@{{ delivery.schedule }}</i> <i>Php@{{
                                                                    delivery.amount }}</i>
                                                                <hr>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <i>@{{ delivery.pick_up }}</i>
                                                                <hr>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <i>@{{ delivery.drop_off }}</i>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="td-actions text-right">
                                                        <a v-bind:href="'/d/m/' + delivery.id"
                                                           class="btn btn-info btn-round">
                                                            <i class="now-ui-icons ui-1_send"></i> Mine
                                                        </a>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    {{--                                    Yours--}}
                                    <div class="tab-pane" id="yours" role="tabpanel" aria-labelledby="yours-tab">
                                        <div class="table-full-width table-responsive">
                                            <table class="table table-responsive">
                                                <tbody>
                                                <tr v-for="delivery in yours">
                                                    <td class="text-left">
                                                        <div class="row">
                                                            <div class="col-md-12" v-if="delivery.photo">
                                                                <img v-bind:src="'/storage/' + delivery.photo.path"
                                                                     class="avatar border-gray delivery-photo">
                                                            </div>
                                                            <div class="col-md-12 row justify-content-center">
                                                                <div class="col-md-auto">
                                                                    @{{ delivery.customer.name }}
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 row justify-content-center">
                                                                <div class="col-md-auto">
                                                                    @{{ delivery.customer.contact}}
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 row justify-content-center">
                                                                <div class="col-md-auto">
                                                                    <label class="badge badge-info  text-white">
                                                                        <strong>@{{ delivery.service }}</strong>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-left">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <i>Php@{{ delivery.amount }}</i>
                                                                <hr>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <i>@{{ delivery.pick_up }}</i>
                                                                <hr>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <i>@{{ delivery.drop_off }}</i>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="td-actions text-right">
                                                        <a v-bind:href="'/d/c/' + delivery.id"
                                                           class="btn btn-warning btn-round">
                                                            <i class="now-ui-icons gestures_tap-01"></i> Complete
                                                        </a>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    {{--                                    complete--}}
                                    <div class="tab-pane" id="complete" role="tabpanel" aria-labelledby="complete-tab">
                                        <div class="table-full-width table-responsive">
                                            <table class="table table-responsive">
                                                <tbody>
                                                <tr v-for="delivery in complete">
                                                    <td class="text-left">
                                                        <div class="row">
                                                            <div class="col-md-12" v-if="delivery.photo">
                                                                <img v-bind:src="'/storage/' + delivery.photo.path"
                                                                     class="avatar border-gray delivery-photo">
                                                            </div>
                                                            <div class="col-md-12 row justify-content-center">
                                                                <div class="col-md-auto">
                                                                    @{{ delivery.customer.name }}
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 row justify-content-center">
                                                                <div class="col-md-auto">
                                                                    @{{ delivery.customer.contact}}
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 row justify-content-center">
                                                                <div class="col-md-auto">
                                                                    <label class="badge badge-info  text-white">
                                                                        <strong>@{{ delivery.service }}</strong>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-left">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <i>Php@{{ delivery.amount }}</i>
                                                                <hr>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <i>@{{ delivery.pick_up }}</i>
                                                                <hr>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <i>@{{ delivery.drop_off }}</i>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    {{--                                                    <td class="td-actions text-right">--}}
                                                    {{--                                                        <a v-bind:href="'/d/c/' + delivery.id" class="btn btn-warning btn-round">--}}
                                                    {{--                                                            <i class="now-ui-icons gestures_tap-01"></i> Completed--}}
                                                    {{--                                                        </a>--}}
                                                    {{--                                                    </td>--}}
                                                </tr>
                                                </tbody>
                                            </table>
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

@section('scripts')
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
