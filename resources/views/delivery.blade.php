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
                                        <a class="nav-link" id="completed-tab" data-toggle="tab" href="#completed"
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
                                                            <div class="col-md-12">
                                                                <img v-bind:src="'/storage/' + delivery.photo.path ">
                                                            </div>
                                                            <div class="col-md-12">
                                                                @{{ delivery.user.name }}
                                                            </div>
                                                            <div class="col-md-12">
                                                                <strong>@{{ delivery.service }}</strong>
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
                                                        <a href="#" class="btn btn-info btn-round">
                                                            <i class="now-ui-icons ui-1_send"></i> Mine
                                                        </a>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="yours" role="tabpanel" aria-labelledby="yours-tab">v</div>
                                    <div class="tab-pane" id="completed" role="tabpanel"
                                         aria-labelledby="completed-tab">c
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
                pending: []
            },
            methods: {
                fetch() {
                    var $this = this;
                    $.ajax({
                        url: '{{ route('delivery.fetch') }}',
                        method: 'POST',
                        success: function (value) {
                            $this.pending = value.pending;
                        }
                    });
                }
            },
            mounted() {
                this.fetch();
            }
        });
    </script>
@endsection
