<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SearchTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/search');
        $response->assertStatus(200);
    }

    public function testSearchFull()
    {
        $data = ["keyword" => "初投稿"];
        $response = $this->json('GET', '/search', $data);
        $response->assertSee('テスト投稿ですよ');
    }
    public function testSearchBubun()
    {
        $data = ["keyword" => "初"];
        $response = $this->json('GET', '/search', $data);
        $response->assertSee('テスト投稿ですよ');
    }
    public function testSearchBad()
    {
        $data = ["keyword" => "kfldasjf"];
        $response = $this->json('GET', '/search', $data);
        $response->assertDontSee('テスト投稿ですよ');
    }
    public function testSearchCategory()
    {
        $response = $this->get('/category/child1');
        $response->assertStatus(200);
        $response->assertSee('Laravelのロゴです');
    }
    public function testSearchCategoryBad()
    {
        $response = $this->get('/category/child2');
        $response->assertStatus(200);
        $response->assertDontSee('Laravelのロゴです');
    }
}
