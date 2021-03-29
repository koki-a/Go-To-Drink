@extends('layouts.app')

@section('title', 'パスワード再設定')

@section('content')
<div class="form inner">
    @if (session('status'))
    <div class="card-text alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    <form method="POST" class="form_box" action="{{ route('password.email') }}">
        @csrf
        <p class="form_top">
            <span class="fa-stack fa-lg">
                <i class="fa fa-circle fa-stack-2x"></i>
                <i class="fa fa-envelope fa-stack-1x"></i>
            </span>
        </p>
        <input type="hidden" name="email" value="{{ $email }}">
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="password" class="form_input" autofocus="true" required="true" placeholder="New Password" />
        <input type="password" class="form_input" autofocus="true" required="true" placeholder="Confirm Password" />          
        
    </form>
</div>

@endsection