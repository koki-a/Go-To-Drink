<section class="shops">
        <div class="shops_inner inner">
            <div class="section_title wow fadeInUp" data-wow-duration="2s">
                <h1>RANKING</h1>
            </div>
            <div class="shops_items">
                @foreach($manyLikeShops as $manyLikeShop)
                <div class="shops_item wow fadeIn" data-wow-duration="3s">
                    <a href="{{ route('shops.show',[$manyLikeShop->id]) }}" class="shops_item_head">
                        @if(!empty($manyLikeShop->shop_file_name))
                        <img src="/storage/{{ $manyLikeShop->shop_file_name }}" alt="shop-image">
                        @else
                        <img src="{{ asset('asset/images/shop1.jpg') }}" alt="shop-default-image">
                        @endif
                    </a>
                    <div class="shops_item_body">
                        <div class="shop_name">
                            <p class="shop_top_name">{{ $manyLikeShop->name }}</p>
                        </div>
                        <div class="shop_item_bottom">
                            <div class="shop_like">
                                <shop-like
                                :initial-is-liked-by = '@json($manyLikeShop->isLikedBy(Auth::user()))'
                                :initial-count-likes='@json($manyLikeShop->count_likes)'
                                :authorized='@json(Auth::check())'
                                endpoint="{{ route('shops.like', ['shop' => $manyLikeShop]) }}"  
                                >
                                </shop-like>
                            </div>
                            <div class="shop_comment">
                                <p class="">{{ $manyLikeShop->genre->name }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
                
        </div>
    </section>