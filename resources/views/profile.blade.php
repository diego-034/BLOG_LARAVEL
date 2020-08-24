@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="jumbotron shadow-lg">
                <div class="row">
                    <div class="col-7">
                        <h1 class="display-4 text-capitalize">{{ $response['OK']->name }}</h1>
                        <h6 class="lead">Email: {{ $response['OK']->email }}</h6>
                    </div>
                    <div class="col-5 text-right">
                        <img src="{{ asset('img/avatar.png') }}"class="img-fluid" style="height: 120px;">
                    </div>
                </div>

                <div class="row">
                    <div class="col-1">
                        <h6 class="lead">Skills: </h6>
                    </div>
                    <div class="col-11"> <span class="badge badge-primary">HTML</span>
                        <span class="badge badge-primary">CSS</span>
                        <span class="badge badge-primary">PHP</span>
                        <span class="badge badge-primary">C#</span>
                        <span class="badge badge-primary">JAVA</span></div>
                </div>


                <hr class="my-4">
                <div class="row">
                    <div class="col-4">
                        <p class="text-capitalize">It uses utility classes for typography and spacing to space content out within the larger container.</p>
                        <button type="button" class="btn btn-primary">
                            Notifications <span class="badge badge-light">4</span>
                        </button>
                    </div>
                    <div class="col-4 text-center">
                        <h3>21,7 K</h3>
                        <h6>Followers</h6>
                        <button type="button" class="btn btn-success">
                            New followers<span class="badge badge-light">9</span>
                            <span class="sr-only">unread messages</span>
                        </button>
                    </div>
                    <div class="col-4 text-center">
                        <h3>245</h3>
                        <h6>Following</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection