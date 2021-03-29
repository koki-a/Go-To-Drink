<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Shop;

class ShopTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * トップ画面の表示内容のテスト
     *
     * @return void
     */
    public function testIndex()
    {
        // テストデータを作成
        $first = factory(Shop::class)->create();
        $second = factory(Shop::class)->create();
        $first->save();
        $second->save();

        // テスト開始
        $response = $this->get('/');

        $response->assertStatus(200)
        ->assertViewIs('top')
        ->assertSee($first->name)->assertSee($first->genre->name)
        ->assertSee($second->name)->assertSee($second->genre->name);
    }
}
