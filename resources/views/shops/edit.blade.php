@extends('layouts.app')

@section('title','店舗更新')

@section('content')
<div class="form inner">
    <div class="form_box">
    <div class="delete">
            <form action="{{ route('shops.destroy',['shop'  => $shop]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="delete_button"  type="submit">DELETE</button>
            </form>
    </div>
        <form method="POST" action="{{ route('shops.update',['shop' => $shop]) }}" enctype="multipart/form-data">
        @method('PATCH')
            @csrf
            @include('commons.errors')
            <p class="form_top hidden-sp">
                <span class="fa-stack fa-lg">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fas fa-store fa-stack-1x"></i>
    
                </span>
            </p>
            <span class="shop_image_form image-picker">
                <input type="file" name="shop-image" class="input_shop_image"  accept="image/png,image/jpeg,image/gif" id="shop-image">
                <label for="shop-image" class="" role="button">
                    @if(!empty($shop->shop_file_name))
                    <img class="shop_image" src="/storage/{{ $shop->shop_file_name }}" style="object-fit: cover; width: 200px; height: 200px;" alt="">
                    @else
                    <img class="shop_image" src="{{asset('asset/images/shop-default.png') }}" style="object-fit: cover; width: 200px; height: 200px;" alt="">
                    @endif
    
                </label>
            </span>
            <input type="name" name="name" class="form_input"  value="{{  $shop->name ?? old('name') }}" autofocus="true" required="true" placeholder="お店の名前" />
            <input type="address" name="address" class="form_input"  value="{{  $shop->address ?? old('address') }}" autofocus="true" required="true" placeholder="住所" />
            <input type="url" name="url" class="form_input"  value="{{  $shop->url ?? old('url') }}" autofocus="true" required="true" placeholder="URL" />
            <input type="tell" name="tell" class="form_input_tell"  value="{{  $shop->tell ?? old('tell') }}" required="true" placeholder="TEL    0115551234" />
            <div class="select_box">
                <select name="genre" class="select">
                    <option value="" hidden>ジャンルを選択</option>
                    @foreach ($genres as $genre)
                    <option value="{{ $genre->id }}" {{old('genre') == $genre->id ? selected : ''}}>
                        {{$genre->name}}
                    </option>
                    @endforeach
                </select>
                <div class="create_checkbox_group">
                    @foreach ($situations as $situation)
                    <input class="create_picky_input" type="checkbox" name="situation_ids[]" value="{{ $situation->id }}">
                    <label class="create_picky_label" for="{{ $situation->id }}">{{ $situation->name }}</label>
                    @endforeach
                </div>
    
    
            </div>
            <label for="" class="label_comment">COMMENT</label>
            <textarea name="comment" class="form_textarea" id="" placeholder=""></textarea>
    
            <button type="submit"class="form_submit">Update</button>
    
        </form>
    </div>
</div>
@endsection