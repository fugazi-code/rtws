@extends('auth.layout.app')

@section('content')
    <!--suppress ALL -->
    <div id="app" class="row">
        <div class="col-md-auto">
            <div class="card card-accent-warning">
                <div class="card-header">
                    Top-Up Request
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" action="{{ route('wallet.top-up.send') }}"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Amount:</label>
                                    <input name="amount" type="number" class="form-control" value="0">
                                </div>
                                <div class="form-group mb-4">
                                    <label>Receipt</label>
                                    <input type="file" name="receipt" class="form-control-file">
                                </div>
                                <button type="submit" class="btn btn-square btn-success">Send</button>
                                <a href="{{ route('wallet') }}" class="btn btn-square btn-secondary">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
