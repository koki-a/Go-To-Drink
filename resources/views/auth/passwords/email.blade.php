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
        <div class="email_comment">
            <p>下記メールアドレスにパスワード再設定依頼メールをお送り致します。</p>
        </div>
        <input type="email" class="form_input" autofocus="true" required="true" placeholder="Email" />
        <input type="submit" name="" value="Send" class="form_submit" />
        
        
    </form>
</div>

@endsection