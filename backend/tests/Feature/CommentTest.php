<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Models\User;
use App\Models\Comment;


class CommentTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testShow()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user);
        $response->get('/admin/home/comment')->assertStatus(200);
    }
    public function testDeleteComment()
    {
        $user = User::factory()->create();
        $comment = Comment::factory()->create();
        $data = [
            'id' => $comment->comment_id
        ];
        $response = $this->actingAs($user);
        $response->post(route('delete_comment'), $data)
            ->assertStatus(302);
        $response->assertDatabaseMissing('comments', ['comment_id' => $comment->comment_id]);
    }
}
