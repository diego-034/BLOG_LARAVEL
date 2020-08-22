@extends('layouts.app')
@section('content')
<div class="uk-container">
    <button class="uk-button uk-button-primary uk-align-right " type="button" onclick="Show()" id="action">New Post</button>
    <center>
        <h1>Hi! Welcome to the blog.</h1>
        @include('components.post')
        @include('components.form')
    </center>
</div>
@endsection