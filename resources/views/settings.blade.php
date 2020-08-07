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
                    <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Payment Options</label>
                                        <select name="role" class="form-control" v-model="role">
                                            <option value="rider">Gcash</option>
                                            <option value="customer">Paymaya</option>
                                            <option value="admin">Bank</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="What do you need help with?"  aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="button" type="button">Submit</button>
                        </div>
                    </div>
                            <a href="#">*Invite Friends</a><br> 
                            <button type="button" class="btn btn-fb"><i class="fab fa-facebook-f"></i></button>
                            <button type="button" class="btn btn-tw"><i class="fab fa-twitter"></i></button>
                            <button type="button" class="btn btn-gplus"><i class="fab fa-google-plus-g"></i></button>
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
