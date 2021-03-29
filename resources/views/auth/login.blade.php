@extends('layouts.app')

@section('title','ログイン')

@section('content')
<div class="form inner">
    <form  method="POST" action="{{ route('login') }}" class="form_box">
    @csrf
    @include('commons.errors')
        <p class="form_top">
            <span class="fa-stack fa-lg">
                <i class="fa fa-circle fa-stack-2x"></i>
                <i class="fa fa-lock fa-stack-1x"></i>
            </span>
        </p>
        <input type="email" name="email" class="form_input" autofocus="true" required="true" placeholder="Email" />
        <input type="password" name="password" class="form_input" required="true" placeholder="Password" />
        <input type="hidden" name="remember" id="remember" value="on">
        <input type="submit" name="Login" value="Login" class="form_submit" />
        <div class="login_forgot">
            <a href="{{ route('password.request') }}" class="login_forgot_pass">Passwordを忘れた方はこちら</a>
        </div>
    </form>
</div>
@endsection