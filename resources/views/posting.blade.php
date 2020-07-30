@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="title">Post to Deliver</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('posting.submit') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 mt-3">
                                    <label>Recipient's Name</label>
                                    <input type="text" name="recipient" class="form-control" value="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mt-3">
                                    <label>Delivery From</label>
                                    <input type="text" name="delivery_from" class="form-control"
                                           value="{{ auth()->user()->address }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mt-3">
                                    <label>Delivery To</label>
                                    <input type="text" name="delivery_to"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mt-3">
                                    <label>Description of Item(s)</label>
                                    <textarea name="description" class="form-control" rows="8"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 mt-3">
                                    <label>Delivery Fee</label>
                                    <input type="number" name="delivery_fee" class="form-control"
                                           value="{{ env('DELIVERY_FEE') }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mt-3">
                                    <button type="submit" class="btn btn-sm btn-success btn-round">Post It Now!</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
