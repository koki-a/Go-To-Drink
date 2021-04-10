<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use App\Shop;
use App\User;

class ShopControllerTest extends TestCase
{
    use RefreshDatabase;

    //トップ画面の表示のテスト
    public function testIndex()
    {
        $response = $this->get(route('shops.top'));

        $response->assertStatus(200)
        ->assertViewIs('top');
    }

    //投稿ページ表示のテスト（未ログイン時）
    public function testGuestCreate()
    {
        $response = $this->get(route('shops.create'));

        $response->assertRedirect(route('login'));
    }    

    //投稿ページ表示のテスト（ログイン済み）
    public function testAuthCreate()
    {

        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
        ->get(route('shops.create'));

        $response->assertStatus(200)
        ->assertViewIs('shops.create');
    } 
    
    //いいね機能のテスト(引数がnullの場合)
    public function testIsLikedByNull()
    {
        $shop = factory(Shop::class)->create();

        $result = $shop->isLikedBy(null);

        $this->assertFalse($result);
    }

    //いいね機能のテスト(いいねをしている場合)
    public function testIsLikedByUser()
    {
        $shop = factory(Shop::class)->create();
        $user = factory(User::class)->create();
        $shop->likes()->attach($user);

        $result = $shop->isLikedBy($user);

        $this->assertTrue($result);
    }

    //いいね機能のテスト(いいねをしていない場合)
    public function testIsLikedByAnother()
    {
        $shop = factory(Shop::class)->create();
        $user = factory(User::class)->create();
        $another = factory(User::class)->create();
        $shop->likes()->attach($another);

        $result = $shop->isLikedBy($user);

        $this->assertFalse($result);
    }

    //ユーザー登録機能のテスト
    public function testRegister()
    {
        $user = new User();
        $user->name = "テストユーザ";
        $user->email = "test_email@test.com";
        $user->password = Hash::make('test_password');
        $user->save();

        $readUser = User::where('name','テストユーザ')->first();

        $this->assertNotNull($readUser);
        $this->assertTrue(Hash::check('test_password', $readUser->password));

    }
}
