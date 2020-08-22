@extends('layouts.app')
@section('content')
<div class="uk-container">
    <center>
    <h1>Hi! Welcome to the Login.</h1>
        <div class="uk-card uk-card-default uk-card-body uk-width-1-2@m uk-margin-top" id="">
            <form>
                <div class="uk-margin uk-margin-top">
                    <div class="uk-inline">
                        <span class="uk-form-icon" uk-icon="icon: user"></span>
                        <input class="uk-input" type="email" placeholder="email@email.com">
                    </div>
                </div>
                <div class="uk-margin">
                    <div class="uk-inline">
                        <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: lock"></span>
                        <input class="uk-input" type="password" placeholder="">
                    </div>
                </div>
                <button class="uk-button uk-button-primary" type="button">Login</button>
            </form>
        </div>

    </center>
</div>
@endsection