@extends('layouts.app')

@section('title','店舗登録')

@section('content')
<div class="form inner">
    <form method="POST" action="{{ route('shops.store') }}" class="form_box"  enctype="multipart/form-data">
        @csrf
        @include('commons.errors')
        <p class="form_top hidden-sp">
            <span class="fa-stack fa-lg">
                <i class="fa fa-circle fa-stack-2x"></i>
                <i class="fas fa-store fa-stack-1x"></i>

            </span>
        </p>
        <span class="shop_image_form image-picker">
            <input type="file" name="shop-image" class="input_shop_image" accept="image/png,image/jpeg,image/gif" id="shop-image">
            <label for="shop-image" class="" role="button">
                <img src="{{asset('asset/images/shop-default.png') }}" style="object-fit: cover; width: 200px; height: 200px;" class="shop_image">
            </label>
        </span>
        <input type="name" name="name" class="form_input" value="{{ old('name') }}" autofocus="true" required="true" placeholder="お店の名前" />
        <input type="address" name="address" class="form_input" value="{{ old('address') }}" autofocus="true" required="true" placeholder="住所" />
        <input type="url" name="url" class="form_input" value="{{ old('url') }}" autofocus="true" required="true" placeholder="URL" />
        <input type="tell" name="tell" class="form_input_tell" value="{{ old('tell') }}" required="true" placeholder="TEL 0115551234" />
        <div class="select_box">
            <select name="genre" class="select">
                <option value="" hidden>ジャンルを選択</option>
                @foreach ($genres as $genre)
                <option value="{{ $genre->id }}" {{old('genre') == $genre->id ? 'selected' : ''}}>{{$genre->name}}</option>
                @endforeach
            </select>
            <div class="create_checkbox_group">
                @foreach ($situations as $situation)
                <input class="create_picky_input" type="checkbox" name="situation_ids[]" id="{{ $situation->id }}" value="{{ $situation->id }}" @if (is_array(old("situation_ids")) && in_array("$situation->id", old('situation_ids'), true)) checked @endif>
                <label class="create_picky_label" for="{{ $situation->id }}">{{ $situation->name }}</label>
                @endforeach
            </div>


        </div>
        <label for="" class="label_comment">COMMENT</label>
        <textarea name="comment" class="form_textarea" id="" placeholder="{{  $shop->comment ?? old('comment') }}"></textarea>

        <button type="submit"class="form_submit">Register</button>

    </form>
</div>
@endsection