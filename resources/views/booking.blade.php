@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-user">
                    <div class="card-header">
                        <h5 class="title">{{ $page_name }}</h5>
                    </div>
                    <div class="card-body">
                        <style>
                            .btn-info:not(:disabled):not(.disabled).active {
                                background-color: #ca8aea !important;
                            }
                        </style>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="btn-group btn-group-toggle btn-block" data-toggle="buttons">
                                    <label class="btn btn-info text-white active">
                                        <input type="radio" name="motorcycle" checked> <strong>Motorcycle</strong>
                                    </label>
                                    <label class="btn btn-info text-white">
                                        <input type="radio" name="car"><strong> Car</strong>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-4">
                                <label>Description</label>
                                <textarea name="description" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 row mt-4">
                            <div class="col-md-6">
                                <label>Pick-Up</label>
                                <input type="datetime-local" name="pick-up" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label>Drop-Off</label>
                                <input type="datetime-local" name="drop-off" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4 mt-4">
                            <label>Amount</label>
                            <input type="number" name="amount" class="form-control">
                        </div>
                        <div class="col-md-12 mt-4">
                            <button type="submit" class="btn btn-round btn-success">Book Now!</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
