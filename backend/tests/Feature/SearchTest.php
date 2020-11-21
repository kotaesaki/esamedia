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
        $response = $this->get('/search', $data);
        $response->assertSee('<h2 class="content-title">初投稿</h2>');
    }
    public function testSearchBubun()
    {
        $data = ["keyword" => "初"];
        $response = $this->get('/search', $data);
        $response->assertSee('<h2 class="content-title">初投稿</h2>');
    }
    public function testSearchBad()
    {
        $data = ["keyword" => "kfldasjf"];
        $response = $this->get('/search', $data);
        $response->assertDontSee('<h2 class="content-title">初投稿</h2>');
    }
}
