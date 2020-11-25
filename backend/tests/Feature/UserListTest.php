<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Models\User;
use App\Models\Post;

class UserListTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testShow()
    {
        $user = User::factory()->create([
            'user_status' => 'admin'
        ]);
        $response = $this->actingAs($user);
        $response->get('/admin/home/users')->assertStatus(200);
    }
    public function testConfirmUser()
    {
        $user = User::factory()->create([
            'user_status' => 'admin'
        ]);
        $delete_user = User::factory()->create();
        $data = [
            'id' => $delete_user->id,
            'delete' => '削除'
        ];
        $response = $this->actingAs($user);
        $response->json('GET', '/admin/home/users/confirm', $data)
            ->assertStatus(200);
    }
    public function testDeleteUser()
    {
        $user = User::factory()->create([
            'user_status' => 'admin'
        ]);
        $delete_user = User::factory()->create();
        Post::factory()->create(['post_author' => $delete_user->id]);
        $data = [
            'id' => $delete_user->id,
            'delete' => 'delete',
            'username' => $user->id
        ];
        $response = $this->actingAs($user);
        $response->json('post', route('delete_user'), $data)
            ->assertRedirect('/admin/home/users');
        $response->assertDatabaseMissing('users', [
            'id' => $delete_user->id,
        ]);
        $response->assertDatabaseMissing('posts', [
            'post_author' => $delete_user->id,
        ]);
    }
    public function testNotDeletePost()
    {
        $user = User::factory()->create([
            'user_status' => 'admin'
        ]);
        $delete_user = User::factory()->create();
        Post::factory()->create(['post_author' => $delete_user->id]);
        $data = [
            'id' => $delete_user->id,
            'delete' => 'not_delete',
            'username' => $user->id
        ];
        $response = $this->actingAs($user);
        $response->json('post', route('delete_user'), $data)
            ->assertRedirect('/admin/home/users');
        $response->assertDatabaseMissing('users', [
            'id' => $delete_user->id,
        ]);
        $response->assertDatabaseMissing('posts', [
            'post_author' => $delete_user->id,
        ]);
        $response->assertDatabaseHas('posts', [
            'post_author' => $user->id,
        ]);
    }
}
