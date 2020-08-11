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
                                    <h5 class="mb-1">Order ID: @{{ book.id }}</h5>
                                    <small>@{{ book.created_at }}</small>
                                </div>
                                <p class="mb-1">Schedule: @{{ book.schedule }}</p>
                                <small>Donec id elit non mi porta.</small>
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
