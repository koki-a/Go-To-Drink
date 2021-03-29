@extends('layouts.app')

@section('title','検索結果')

@section('content')
<section class="shops">
    <div class="shops_inner inner">
        <div class="section_title wow fadeIn" data-wow-duration="2s">
            <h1>SEARCH</h1>
        </div>
        <div class="shops_items">
            @foreach($shops as $shop)
            <div class="shops_item wow fadeIn" data-wow-duration="2s">
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