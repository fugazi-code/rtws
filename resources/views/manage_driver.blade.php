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
                        <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action"  v-for="book in books">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">#@{{ book.id }} Order No.
                                        <span v-if="book.status == 'pending'" class="badge badge-info">Looking for a Rider</span>
                                        <span v-else class="badge badge-info">@{{ book.status }}</span>
                                    </h5>
                                    <small>@{{ book.created_at }}</small>
                                </div>
                                <p class="mb-1">Scheduled pick-up is @{{ book.schedule }}</p>
                                <p class="mb-1">Amount would be Php@{{ book.amount }}</p>
                                <small>@{{ book.pick_up }} to @{{ book.drop_off }}</small>
                                <p class="mb-1"><button class="btn btn-sm btn-round btn-danger">Cancel Order</button></p>
                            </a>
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
                books:[]
            },
            methods: {
                fetch() {
                    var $this = this;
                    $.ajax({
                        url: '{{ route('manage.fetch') }}',
                        method: 'POST',
                        success(value) {
                            $this.books = value.booking.data;
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
