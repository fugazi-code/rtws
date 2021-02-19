@extends('auth.layout.app')

@section('content')
    <!--suppress ALL -->
    <div id="app" class="row">
        <div class="col-md-12 p-0">
            <div class="card card-accent-warning">
                <div class="card-header">
                    Promo Codes
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="input-group">
                                <input type="number" class="form-control" placeholder="Discount" v-model="discount">
                                <div class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <button class="btn btn-block btn-success" @click="generate">Generate</button>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <ul class="list-group">
                                <li class="list-group-item" v-for="promo in promo_codes">
                                    <div class="row">
                                        <div class="col" v-if="promo.status == 'unused'">
                                            <span class="badge bg-primary text-white">
                                                @{{ promo.status }}
                                            </span>
                                        </div>
                                        <div class="col" v-else>
                                            <span class="badge bg-success text-white">
                                                @{{ promo.status }}
                                            </span>
                                        </div>
                                        <div class="col">
                                            @{{ promo.code }}
                                        </div>
                                        <div class="col-auto">
                                            @{{ promo.discount }}%
                                        </div>
                                        <div class="col-auto">
                                            <button class="btn btn-sm btn-danger" @click="remove(promo.id)">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </li>
                            </ul>
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
                discount: null,
                promo_codes: []
            },
            methods: {
                remove: function (id) {
                    var $this = this;
                    $.ajax({
                        url: '{{ route('code.remove') }}',
                        method: 'POST',
                        data: {id: id},
                        success: function (value) {
                            $this.fetch();
                            swal('Success!', 'New Promo Code has been removed.', 'success')
                        }
                    });
                },
                generate: function () {
                    var $this = this;
                    if ($this.discount === null) {
                        swal('Please try again!', 'No Discount indicated.', 'error');
                        return false;
                    }
                    $.ajax({
                        url: '{{ route('code.generate') }}',
                        method: 'POST',
                        data: {discount: $this.discount},
                        success: function (value) {
                            $this.fetch();
                            $this.discount = null;
                            swal('Success!', 'New Promo Code has been created.', 'success')
                        }
                    });
                },
                fetch: function () {
                    var $this = this;
                    $.ajax({
                        url: '{{ route('code.fetch') }}',
                        method: 'POST',
                        success: function (value) {
                            $this.promo_codes = value;
                        }
                    })
                }
            },
            mounted() {
                this.fetch();
            }
        })
    </script>
@endsection
