<?php

namespace Tests\Feature;


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
        $data = ["keyword" => "Laravelの記事"];
        $response = $this->json('GET', '/search', $data);
        $response->assertSee('Laravelのロゴです');
    }
    public function testSearchBubun()
    {
        $data = ["keyword" => "Lara"];
        $response = $this->json('GET', '/search', $data);
        $response->assertSee('Laravelのロゴです');
    }
    public function testSearchBad()
    {
        $data = ["keyword" => "kfldasjf"];
        $response = $this->json('GET', '/search', $data);
        $response->assertDontSee('Laravelのロゴです');
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
    public function testSearchTag()
    {
        $response = $this->get('/tag/Test1');
        $response->assertStatus(200);
        $response->assertSee('Laravelのロゴです');
    }
    public function testSearchtagBad()
    {
        $response = $this->get('/tag/test2');
        $response->assertStatus(200);
        $response->assertDontSee('Laravelのロゴです');
    }
}
