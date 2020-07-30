@extends('layouts.app')

@section('content')
    <div id="app" class="content">
        <div class="row">
            <div class="col-md-auto">
                <div class="card">
                    <div class="card-header">
                        <h5 class="title">My Orders</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-full-width table-responsive">
                            <table class="table">
                                <thead>
                                    <th>Requests</th>
                                    <th>Recipient</th>
                                    <th>Address</th>
                                    <th>Status</th>
                                </thead>
                                <tbody>
                                <tr v-for="order in order_list">
                                    <td>
                                        <button class="btn btn-primary btn-neutral" style="padding: 0; font-size: 20px;">
                                            <i class="now-ui-icons shopping_delivery-fast"></i> 0
                                        </button>
                                    </td>
                                    <td class="text-left">@{{ order.recipient }}</td>
                                    <td class="text-left">@{{ order.delivery_to }}</td>
                                    <td class="text-left"><span class="badge badge-warning">Pending</span></td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" title="" class="btn btn-info btn-round btn-icon btn-icon-mini btn-neutral" data-original-title="Edit Task">
                                            <i class="now-ui-icons ui-2_settings-90"></i>
                                        </button>
                                        <button type="button" rel="tooltip" title="" class="btn btn-danger btn-round btn-icon btn-icon-mini btn-neutral" data-original-title="Remove">
                                            <i class="now-ui-icons ui-1_simple-remove"></i>
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    const v = new Vue({
        el:'#app',
        data() {
          return {
              order_list: []
          }
        },
        methods: {
            orderFetch() {
                var $this = this;
                $.ajax({
                    url: '{{ route('orders.fetch') }}',
                    method: 'POST',
                    success(value) {
                        $this.order_list = value;
                    }
                });
            }
        },
        mounted() {
            this.orderFetch();
        }
    });
</script>
@endsection
