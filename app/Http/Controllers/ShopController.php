<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shop;
use App\Genre;
use App\Situation;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ShopRequest;


class ShopController extends Controller
{
    //ShopPolicyを使用
    public function __construct()
    {
        $this->authorizeResource(Shop::class, 'shop');
    }

    //トップ・検索画面表示
    public function index()
    {
        $shops = Shop::with('genre','likes')->orderBy('id',"desc")->take(3)->get();
        $genres = Genre::orderBy('id','asc')->get();
        $situations = Situation::orderBy('id','asc')->get();
        //いいね数が多い順に取得
        $manyLikeShops = Shop::withCount('likes')->orderBy('likes_count','desc')->with('genre','likes')->take(3)->get();

        return view('top')
        ->with('shops',$shops)
        ->with('genres',$genres)
        ->with('situations',$situations)
        ->with('manyLikeShops',$manyLikeShops);
    }

    //商品詳細画面表示
    public function show(Shop $shop)
    {
        $user = $shop->user;

        return view('shops.show')
        ->with('shop',$shop)
        ->with('user',$user);
    }

    //商品登録画面表示
    public function create()
    {
        $genres = Genre::orderBy('id','asc')->get();
        $situations = Situation::orderBy('id','asc')->get();

        return view('shops.create')
        ->with('genres',$genres)
        ->with('situations',$situations);
        
    }

    //商品登録
    public function store(ShopRequest $request,Shop $shop)
    {  
        if ($request->has('shop-image')) {
            $filePath = $request->file('shop-image')->store('public');
            $shop->shop_file_name = str_replace('public/', '', $filePath);
        }
        $shop->user_id = $request->user()->id;
        $shop->genre_id = $request->input('genre');
        $shop->name = $request->input('name');
        $shop->address = $request->input('address');
        $shop->url = $request->input('url');
        $shop->tell = $request->input('tell');
        $shop->comment = $request->input('comment');
        
        DB::beginTransaction();
        try {
            DB::commit();
            $shop->save();
            $situation_ids = $request->situation_ids;
            $shop->situations()->sync($situation_ids,false);
        } catch (\Exception $e) {
            DB::rollback();
            abort(500);
        }

        return redirect()->route('shops.top')
        ->with('shop',$shop);
    }

    //店舗更新画面表示
    public function edit(Shop $shop)
    {
        $genres = Genre::orderBy('id','asc')->get();
        $situations = Situation::orderBy('id','asc')->get();
        
        return view('shops.edit')
        ->with('shop',$shop)
        ->with('genres',$genres)
        ->with('situations',$situations);
    }

    //店舗更新処理
    public function update(ShopRequest $request, Shop $shop)
    {
        if ($request->has('shop-image')) {
            $filePath = $request->file('shop-image')->store('public');
            $shop->shop_file_name = str_replace('public/', '', $filePath);
            
        }

        $shop->genre_id = $request->input('genre');
        $shop->name = $request->input('name');
        $shop->address = $request->input('address');
        $shop->url = $request->input('url');
        $shop->tell = $request->input('tell');
        $shop->comment = $request->input('comment');
        
        DB::beginTransaction();
        try {
            DB::commit();
            $shop->save();
            $situation_ids = $request->situation_ids;
            $shop->situations()->sync($situation_ids,false);
        } catch (\Exception $e) {
            DB::rollback();
            abort(500);
        }

        return redirect()->route('shops.top')
        ->with('shop',$shop);
    }

    //店舗削除機能
    public function destroy(Shop $shop)
    {
        $shop->delete();
        return redirect()->route('shops.top');
    }

    //いいねを付ける
    public function like(Request $request, Shop $shop)
    {
        $shop->likes()->detach($request->user()->id);
        $shop->likes()->attach($request->user()->id);

        return [
            'id' => $shop->id,
            'countLikes' => $shop->count_likes,
        ];
    }

    //いいねを外す
    public function unlike(Request $request, Shop $shop)
    {
        $shop->likes()->detach($request->user()->id);

        return [
            'id' => $shop->id,
            'countLikes' => $shop->count_likes,
        ];
    }

    //検索処理
    public function search(Request $request)
    {
        $genres = Genre::orderBy('id','asc')->get();
        $situations = Situation::orderBy('id','asc')->get();

        $genre_input = $request->input('genre');
        $situations_input = $request->input('situation_ids');
        
        //ジャンル、こだわり両方空の場合（全体検索）
        if(empty($genre_input) && empty($situations_input)) {

            $shops = Shop::with('genre','likes')->orderBy('id','desc')->paginate(6);

        }
        
        //ジャンルが入力済で、こだわりが空の場合
        elseif(!empty($genre_input) && empty($situations_input)){

            $shops = Shop::with('genre','likes')->where('genre_id',$genre_input)->paginate(6);
        }

        //ジャンルが空で、こだわりが入力済の場合
        elseif(empty($genre_input) && !empty($situations_input)){

            $shops = Shop::with('genre','likes')->whereHas('situations',function($query)use($situations_input){
                $query->whereIn('situations.id',$situations_input);
            })->paginate(6);
        }

        //ジャンル、こだわり両方が入力済の場合
        elseif(!empty($genre_input) && !empty($situations_input)){

            $shops = Shop::with('genre','likes')->where('genre_id',$genre_input)
            ->whereHas('situations',function($query)use($situations_input){
                $query->whereIn('situations.id',$situations_input);
            })->paginate(6);
        }

        return view('shops.searched')
        ->with('shops',$shops)
        ->with('genres',$genres)
        ->with('situations',$situations);
        
    }

}
