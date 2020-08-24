@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
        <button class="btn btn-primary float-right" type="button" onclick="Show()" id="action">New Post</button>

            <!-- <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                   
                </div>
            </div> -->
            @include('components.posts')
            @include('components.form')
        </div>
    </div>
</div>
@endsection
