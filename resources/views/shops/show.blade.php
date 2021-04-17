@extends('layouts.app')

@section('title','店舗詳細')



@section('content')
<section class="shop_detail">
    <div class="inner shop_detail_inner">
        @if(Auth::id() === $shop->user_id)
        <div class="show_top">
            <a class="edit_button" href="{{ route('shops.edit', ['shop' => $shop])  }}">
                EDIT
            </a>
        </div>
        @endif
        <p class="form_top">
            <span class="fa-stack fa-2x">
                <i class="fa fa-circle fa-stack-2x"></i>
                <i class="fas fa-beer fa-stack-1x"></i>
            </span>
        </p>
        <div class="shop_detail_image">
            @if(!empty($shop->shop_file_name))
            <img class="shop_detail_image" src="/storage/{{ $shop->shop_file_name }}" alt="">
            @else
            <img class="shop_detail_image" src="{{ asset('asset/images/shop1.jpg') }}" alt="">
            @endif
        </div>
        <div class="shop_detail_box">
            <div class="shop_block">
                <div class="shop_detail_title">
                    <p>店名：</p>
                </div>
                <div class="shop_detail_content">
                    @if(!empty($shop->url))
                    <a class="shop_show_name" href="{{ $shop->url}}" target="_blank" rel="noopener noreferrer">{{ $shop->name}}</a>
                    @else
                    <p class="shop_show_name">{{ $shop->name}}</p>
                    @endif
                </div>
            </div>
            <div class="shop_block">
                <div class="shop_detail_title">
                    <p>ジャンル：</p>
                    <p class="shop_detail_title_second">こだわり：</p>
                </div>
                <div class="shop_detail_content">
                    <p class="genre_name">{{ $shop->genre->name}}</p>
                    @foreach($shop->situations as $situation)
                    <p class="situation_name">{{ $situation->name }}</p>
                    @endforeach
                </div>
            </div>
            <div class="shop_block">
                <div class="shop_detail_title">
                    <p>電話番号：</p>
                </div>
                <div class="shop_detail_content">
                    <a class="tell" href="tel:{{ $shop->tell}}">{{ $shop->tell}}</a>
                </div>
            </div>
            <div class="shop_block">
                <div class="shop_detail_title">
                    <p>住所：</p>
                </div>
                <div class="shop_detail_content">
                    <p>{{ $shop->address}}</p>
                </div>
            </div>
            <iframe class="shop_goggle_address" id='map' src='https://www.google.com/maps/embed/v1/place?key={{ config("services.google-map.apikey") }}&q={{ $shop->name }} {{$shop->address}}' frameborder='0'></iframe>
            <div class="shop_block">
                <div class="shop_detail_title">
                    @if(!empty($user->avatar_file_name))
                    <a href="{{ route('users.show',['name' => $shop->user->name]) }}">
                        <img class="shop_image avatar_circle" src="/storage/{{ $user->avatar_file_name }}" style="object-fit: cover; width: 60px; height: 60px;" alt="">
                    </a><br>
                    @else
                    <a href="{{ route('users.show',['name' => $shop->user->name]) }}">
                        <i class="user_icon fas fa-user-circle fa-4x my-white"></i>
                    </a>
                    @endif
                    </div>
                <div class="shop_detail_content">
                    <p>{{ $shop->comment}}</p>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection