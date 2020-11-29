@extends('auth.layout.app')

@section('content')
    <!--suppress ALL -->
    <div id="app" class="row">
        <div class="col-md-4">
            <div class="card card-accent-warning">
                <div class="card-header">
                    Top-Up Edit
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" action="{{ route('topup.update') }}">
                                @csrf
                                <input name="id" value="{{ $topup->id }}" hidden>
                                <div class="form-group">
                                    <label>Status of ID {{ $topup->id }}</label>
                                    <select name="status" class="form-control">
                                        <option value="approved" @if($topup->status == 'approved') selected @endif>Approved</option>
                                        <option value="denied" @if($topup->status == 'denied') selected @endif>Denied</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-square btn-success">Send</button>
                                <a href="{{ route('topup.requests') }}" class="btn btn-square btn-secondary">Cancel</a>
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
