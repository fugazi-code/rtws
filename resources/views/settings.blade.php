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
                    {{--WALLET--}}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="btn-group btn-group-toggle btn-block" data-toggle="buttons">
                                        <label class="btn btn-info text-white active">
                                            <input type="radio" name="balance" value="balance
                                                   @click="setWallet('balance')" checked>
                                            <h1><label class="text" id="balance"><b>0.00</b></label></h1>
                                            <strong>Available Balance(&#8369;)</strong>
                                        </label>
                                        </div>
                                    </div>
                                </div>
                            {{--WALLET--}}
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Payment Methods</li>
                    </ol>
                    <button type="button" class="btn btn-success btn-lg btn-block">G-Cash</button>
                    <button type="button" class="btn btn-success btn-lg btn-block">Paymaya</button>
                    <button type="button" class="btn btn-success btn-lg btn-block">Bank</button>

                    <div class="form-group">
                        <label for="balance"></label>
                    </div>
                    <p>?Help Center -- <a href="#">(rtws@gmail.com)</a></p>
                    <a href="#">Invite Friends</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>$(document).ready(function(){
   // alert('haha')
})</script>
@endsection
