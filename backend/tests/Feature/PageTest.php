<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Post;
use App\Models\Comment;
use App\Http\Controllers\PageController;




class PageTest extends TestCase
{
    public function testShowPage()
    {
        $response = $this->get('/pages/1');
        $response->assertStatus(200);
    }
    public function testSendFull()
    {
        $comment = Comment::factory()->create();
        $data = [
            'comment_author' => $comment->comment_author,
            'comment_author_email' => $comment->comment_author_email,
            'comment_author_url' => $comment->comment_author_url,
            'comment_author_ip' => $comment->comment_author_ip,
            'comment_content' => $comment->comment_content,
            'comment_post_id' => $comment->comment_post_id
        ];
        $response = $this->from('/pages/1')->post('/pages/1/comment', $data);
        $this->assertDatabaseHas('comments', $data);
        $response->assertRedirect('/pages/1');
    }
    public function testSendOk()
    {
        $comment = Comment::factory()->create([
            'comment_author_url' => 0
        ]);
        $data = [
            'comment_author' => $comment->comment_author,
            'comment_author_email' => $comment->comment_author_email,
            'comment_author_url' => $comment->comment_author_url,
            'comment_author_ip' => $comment->comment_author_ip,
            'comment_content' => $comment->comment_content,
            'comment_post_id' => $comment->comment_post_id
        ];
        $response = $this->from('/pages/1')->post('/pages/1/comment', $data);
        $this->assertDatabaseHas('comments', $data);
        $response->assertRedirect('/pages/1');
    }
    public function testSendBad()
    {
        $data = [
            'comment_author_ip' => "172.22.0.1",
            'comment_post_id' => "1"
        ];
        $response = $this->from('/pages/1')->post('/pages/1/comment', $data);
        $response->assertRedirect('/pages/1');
    }
}
