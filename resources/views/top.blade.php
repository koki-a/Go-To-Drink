@extends('layouts.app')

@section('title','GoToDrink')

@section('content')
<div class="top">
        <div class="inner top_inner">
            <div class="top_box">
                <div class="top_title hidden-sp wow fadeIn" data-wow-duration="3s">
                    <h1>Go To Drink</h1>
                </div>
            </div>

            <form action="{{ route('shops.searched') }}" method="POST" class="control">   
                @csrf        
                <div class="control_genre wow fadeIn" data-wow-duration="3s">
                    <input class="control_input" id="ac-1" name="" type="checkbox" />
                    <label class="control_label" for="ac-1">ジャンル</i></label>
    
                    <div class="genre_radios">
                        @foreach($genres as $genre)
                        <div class="genre_radio">
                            <input class="genre_input" type="radio" value="{{ $genre->id }}" name="genre" id="{{ $genre->id }}" />
                            <label class="genre_label" for="{{ $genre->id }}">{{$genre->name }}</label>
                        </div>
                        @endforeach
                    </div>
                </div>
                
                <div class="control_picky wow fadeIn" data-wow-duration="3s">
                    <input class="control_input" id="ac-2" name="" type="checkbox" />
                    <label class="control_label" for="ac-2">こだわり</label>
    
                    <div action="" class="picky_checkboxes">
                    @foreach ($situations as $situation)
                        <div class="picky_checkbox">
                            <input class="picky_input" type="checkbox"  value="{{ $situation->id }}" name="situation_ids[]" id="picky{{ $situation->id }}" />
                            <label class="picky_label" for="picky{{ $situation->id }}">{{$situation->name}}</label>
                        </div>
                    @endforeach
                    </div>
                </div>

                <div class="control_search wow fadeIn" data-wow-duration="3s">
                    <button class="search_button" type="submit">
                        検索
                    </button>
                </div>
            </form>
            
        </div>
    </div> <!-- /top -->
    
    <section class="shops">
        <div class="shops_inner inner">
            <div class="section_title wow fadeInUp" data-wow-duration="3s">
                <h1 class="">New Shop</h1>
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
                                <shop-like
                                :initial-is-liked-by = '@json($shop->isLikedBy(Auth::user()))'
                                :initial-count-likes='@json($shop->count_likes)'
                                :authorized='@json(Auth::check())'
                                endpoint="{{ route('shops.like', ['shop' => $shop]) }}"  
                                >
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
                
        </div>
    </section>
    @include('commons.shops-likes')


@endsection