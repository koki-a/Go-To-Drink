<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Shop;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\EditRequest;

class UserController extends Controller
{
    //ユーザーページ表示
    public function show($name)
    {
        $user = User::where('name',$name)->first();
        $shops = Shop::with('genre','likes')->where('user_id',$user->id)->paginate(6);
        $myShops = Shop::where('user_id',$user->id)->get();
        $countShops = count($myShops);


        return view('users.show')
        ->with('user',$user)
        ->with('shops',$shops)
        ->with('countShops',$countShops);
    }

    //プロフィール編集画面表示
    public function edit($name)
    {
        $user = User::where('name',$name)->first();

        return view('users.edit')
        ->with('user',$user);
    }
    
    //プロフィール編集処理
    public function update(EditRequest $request,$name)
    {
        $user = User::where('name',$name)->first();

        if ($request->has('avatar')) {
            $filePath = $request->file('avatar')->store('public');
            $user->avatar_file_name = str_replace('public/', '', $filePath);
        }
        $user->name = $request->input('name');

        DB::beginTransaction();
        try {
            DB::commit();
            $user->save();
        } catch (\Exception $e) {
            DB::rollback();
            abort(500);
        }

        return redirect()->route('users.show',['name' => $user->name])
        ->with('user',$user);
    }
}
