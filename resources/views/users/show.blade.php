@extends('layouts.app')

@section('title','ユーザーページ')

@section('content')

<section class="user">
    <div class="user_inner inner">
        <div class="user_box wow fadeIn" data-wow-duration="3s">
            @if(Auth::id() === $user->id)
            <div class="user_box_top">
                <a href="{{ route('users.edit',['name' => Auth::user()->name]) }}" class="profile_edit_button">Profile Edit</a>
            </div>
            @endif
            <div class="user_image_box">
                @if(!empty($user->avatar_file_name))
                <img class="user_image avatar_circle" src="/storage/{{ $user->avatar_file_name }}"  alt="">
                @else
                <i class="user_image fas fa-user-circle fa-10x my-white"></i>
                @endif
            </div>
            <div class="user_name">
                <p>{{ $user->name }}</p>
            </div>
        </div>

        <div class="section_title wow fadeIn" data-wow-duration="3s">
            <h1><span class="count_shop">{{ $countShops }}</span> Shop</h1>
        </div>
        <div class="shops_items">
            @foreach($shops as $shop)
            <div class="shops_item wow fadeIn" data-wow-duration="3s">
                <a href="{{ route('shops.show',[$shop->id]) }}" class="shops_item_head">
                    @if(!empty($shop->shop_file_name))
                    <img src="/storage/{{ $shop->shop_file_name }}" alt="shop-image">
                    @else
                    <img src="{{ asset('asset/images/shop1.jpg') }}" alt="shop-default-image">
                    @endif
                </a>
                <div class="shops_item_body">
                    <div class="shop_name">
                        <p class="shop_top_name">{{ $shop->name }}</p>
                    </div>
                    <div class="shop_item_bottom">
                        <div class="shop_like">
                            <shop-like :initial-is-liked-by='@json($shop->isLikedBy(Auth::user()))' :initial-count-likes='@json($shop->count_likes)' :authorized='@json(Auth::check())' endpoint="{{ route('shops.like', ['shop' => $shop]) }}">
                            </shop-like>
                        </div>
                        <div class="shop_comment">
                            <p class="">{{ $shop->genre->name }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        {{$shops->links()}}
    </div>
</section>

@endsection