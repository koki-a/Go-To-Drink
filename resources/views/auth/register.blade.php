@extends('layouts.app')

@section('title','ユーザ登録')

@section('content')
<div class="form inner">
    <form method="POST" action="{{ route('register') }}" class="form_box">
        @csrf
        @include('commons.errors')
        <p class="form_top">
            <span class="fa-stack fa-lg">
                <i class="fa fa-circle fa-stack-2x"></i>
                <i class="far fa-user fa-stack-1x"></i>
            </span>
        </p>
        <input type="name" name="name" class="form_input" autofocus="true" required="true" placeholder="Name" />
        <input type="email" name="email" class="form_input" autofocus="true" required="true" placeholder="Email" />
        <input type="password"  name="password" class="form_input" required="true" placeholder="Password" />
        <input type="password"  name="password_confirmation" class="form_input" placeholder="Password Confirm"  required>
        <input type="submit" name="Register" value="Register" class="form_submit" />
        <div class="form_bottom">
            <a href="{{ route('login') }}" class="logged_in">登録済みの方はこちら</a>
        </div>
    </form>
</div>
@endsection