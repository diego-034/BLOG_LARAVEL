@extends('layouts.app')
@section('content')
<div class="uk-container">
    <center>
    <h1>Hi! Welcome to the Sign in.</h1>
        <div class="uk-card uk-card-default uk-card-body uk-width-1-2@m uk-margin-top" id="">
            <form class="uk-form-horizontal uk-margin-large">
                <div class="uk-margin">
                    <label class="uk-form-label" for="name">Name</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="name" type="text" placeholder="Name">
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label" for="lastname">Lastname</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="lastname" type="text" placeholder="Lastname">
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label" for="email">Email</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="email" type="email" placeholder="Email">
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label" for="password">Password</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="password" type="password">
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label" for="confirm_password">Confirm Password</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="confirm_password" type="password">
                    </div>
                </div>
                <button class="uk-button uk-button-primary" type="button" onclick="Singin()">Sing in</button>
            </form>
        </div>
    </center>
</div>
@endsection