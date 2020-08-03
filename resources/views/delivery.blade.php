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

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="available-tab" data-toggle="tab" href="#available" role="tab"
                                   aria-controls="home" aria-selected="true">Available</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="yours-tab" data-toggle="tab" href="#yours" role="tab"
                                   aria-controls="profile" aria-selected="false">Yours</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="completed-tab" data-toggle="tab" href="#completed" role="tab"
                                   aria-controls="messages" aria-selected="false">Completed</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="available" role="tabpanel" aria-labelledby="available-tab">a</div>
                            <div class="tab-pane" id="yours" role="tabpanel" aria-labelledby="yours-tab">v</div>
                            <div class="tab-pane" id="completed" role="tabpanel" aria-labelledby="completed-tab">c</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
