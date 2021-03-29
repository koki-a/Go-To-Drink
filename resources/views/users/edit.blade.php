@extends('layouts.app')

@section('title','プロフィール編集')

@section('content')

<body>
    <div class="form inner">
        <form action="{{ route('users.update',['name' => Auth::user()->name ]) }}" method="POST" class="form_box" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('commons.errors')
            <p class="form_top hidden-sp">
                <span class="fa-stack fa-lg">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fas fa-user-cog fa-stack-1x"></i>
                </span>
            </p>
            <span class="shop_image_form image-picker">
                <input type="file" name="avatar" class="input_shop_image" accept="image/png,image/jpeg,image/gif" id="avatar">
                <label for="avatar" class="avatar_circle picker" role="button">
                    @if(!empty($user->avatar_file_name))
                    <img src="/storage/{{ $user->avatar_file_name }}" class="avatar_circle" class="shop_image">
                    @else
                    <img src="{{ asset('asset/images/avatar-default.svg') }}" class="avatar_circle" class="shop_image">
                    @endif
                </label>
            </span>
            <input type="name" name="name" class="form_input"  value="{{  $user->name ?? old('name') }}" autofocus="true" required="true" placeholder="Name" />
            <input type="submit" name="update" value="Update" class="form_submit" />
        </form>
    </div>
</body>
@endsection