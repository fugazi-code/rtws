@extends('auth.layout.app')

@section('content')
    <div id="app" class="row">
        <div class="col-md-12">
            <div class="card card-accent-warning">
                <div class="card-header">Edit Account</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" action="{{ route('accounts.signup.submit') }}"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Role</label>
                                            <select name="role" class="form-control" v-model="role">
                                                <option value="rider">Rider</option>
                                                <option value="customer">Customer</option>
                                                <option value="admin">Admin</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="status" class="form-control">
                                                <option value="for verification" selected>For Verification</option>
                                                <option value="active">Active</option>
                                                <option value="not active">Not Active</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input name="name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>E-mail</label>
                                            <input name="email" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Birth Date</label>
                                            <input type="date" name="birth_date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Contact</label>
                                            <input name="contact" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Postal Code</label>
                                            <input name="postal_code" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input name="address" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Country</label>
                                            <input name="country" class="form-control" value="Philippines">
                                        </div>
                                    </div>
                                    <div v-if="role == 'rider'" class="col-md-6">
                                        <div class="form-group">
                                            <label>License No</label>
                                            <input name="license_no" class="form-control">
                                        </div>
                                    </div>
                                    <div v-if="role == 'rider'" class="col-md-6">
                                        <div class="form-group">
                                            <label>Plate No</label>
                                            <input name="plate_no" class="form-control">
                                        </div>
                                    </div>
                                    <div v-if="role == 'rider'" class="col-md-6">
                                        <div class="form-group">
                                            <label>Official Reciept</label>
                                            <input name="or" class="form-control">
                                        </div>
                                    </div>
                                    <div v-if="role == 'rider'" class="col-md-6">
                                        <div class="form-group">
                                            <label>Certificate Of Registration</label>
                                            <input name="cr" class="form-control">
                                        </div>
                                    </div>
                                    <div v-if="role == 'rider'" class="col-md-6">
                                        <button type="submit" class="btn btn-round btn-success">Submit</button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 row justify-content-center mt-3">
                                        <div class="col-md-12 mt-3">
                                            <label>Selfie Photo</label>
                                            <input type="file" name="selfie_photo" style="max-width: 100%;">
                                        </div>
                                    </div>
                                    <div class="col-md-3 row justify-content-center mt-3">
                                        <div v-if="role == 'rider'" class="col-md-12 mt-3">
                                            <label>License Plate</label>
                                            <input type="file" name="license_plate" style="max-width: 100%;">
                                        </div>
                                    </div>
                                    <div class="col-md-3 row justify-content-center mt-3">
                                        <div v-if="role == 'rider'" v-if="role == 'rider'" class="col-md-12 mt-3">
                                            <label>Front</label>
                                            <input type="file" name="front" style="max-width: 100%;">
                                        </div>
                                    </div>
                                    <div class="col-md-3 row justify-content-center mt-3">
                                        <div v-if="role == 'rider'" class="col-md-12 mt-3">
                                            <label>Side</label>
                                            <input type="file" name="side" style="max-width: 100%;">
                                        </div>
                                    </div>
                                    <div class="col-md-3 row justify-content-center mt-3">
                                        <div v-if="role == 'rider'" class="col-md-12 mt-3">
                                            <label>Back</label>
                                            <input type="file" name="back" style="max-width: 100%;">
                                        </div>
                                    </div>
                                    <div class="col-md-3 row justify-content-center mt-3">
                                        <div v-if="role == 'rider'" class="col-md-12 mt-3">
                                            <label>OR/CR</label>
                                            <input type="file" name="or_cr" style="max-width: 100%;">
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center mt-3">
                                    <div class="col-md-auto">
                                        <button type="submit" class="btn btn-square btn-lg btn-success">Submit
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const s = new Vue({
            el: "#app",
            data() {
                return {
                    role: 'rider'
                }
            },
            mounted() {
                var $this = this;
            }
        })
    </script>
@endsection
