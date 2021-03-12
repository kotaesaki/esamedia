<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use App\Models\User;
use App\Models\Post;


class FormTest extends TestCase
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
        $response->get('/admin/home/new')->assertStatus(200);
    }
    public function testNewPost()
    {
        $user = User::factory()->create([
            'user_status' => 'admin'
        ]);
        $post = Post::factory()->create([
            'post_author' => $user->id
        ]);
        Storage::fake('test');
        $file = UploadedFile::fake()->image('test.png', 600, 400);
        $data = [
            'image' => $file,
            'post_title' => $post->post_title,
            'post_content' => $post->post_content,
            'post_excerpt' => $post->post_excerpt,
        ];
        $response = $this->actingAs($user);
        $response->json('post', route('new_post'), $data);
        $this->assertDatabaseHas('posts', ['post_id' => $post->post_id]);
        $file->move('storage/framework/testing/disks/test');
        Storage::disk('test')->assertExists($file->getFilename());
    }
    public function testNewPostValidate()
    {
        $user = User::factory()->create([
            'user_status' => 'admin'
        ]);
        $response = $this->actingAs($user);
        $response->json('post', route('new_post'), $data = [])
            ->assertStatus(422);
    }
    public function testShowEdit()
    {
        $user = User::factory()->create([
            'user_status' => 'admin'
        ]);
        $post = Post::factory()->create([
            'post_author' => $user->id
        ]);
        $response = $this->actingAs($user);
        $response->get('/admin/home/' . $post->post_id . '/edit')->assertStatus(200);
    }
    public function testEditPost()
    {
        $user = User::factory()->create([
            'user_status' => 'admin'
        ]);
        $post = Post::factory()->create([
            'post_author' => $user->id
        ]);
        Storage::fake('test');
        $file = UploadedFile::fake()->image('test.png', 600, 400);
        $data = [
            'image' => $file,
            'post_title' => $post->post_title,
            'post_content' => $post->post_content,
            'post_excerpt' => $post->post_excerpt,
            'post_id' => $post->post_id
        ];
        $response = $this->actingAs($user);
        $response->json('post', route('edit_post'), $data);
        $this->assertDatabaseHas('posts', ['post_id' => $post->post_id]);
        $file->move('storage/framework/testing/disks/test');
        Storage::disk('test')->assertExists($file->getFilename());
    }
    public function testEditPostValidate()
    {
        $user = User::factory()->create([
            'user_status' => 'admin'
        ]);
        $response = $this->actingAs($user);
        $response->json('post', route('edit_post'), $data = [])
            ->assertStatus(422);
    }
    public function testDeletePost()
    {
        $user = User::factory()->create([
            'user_status' => 'admin'
        ]);

        $post = Post::factory()->create([
            'post_author' => $user->id
        ]);
        $data = [
            'post_id' => $post->post_id
        ];
        $response = $this->actingAs($user);
        $response->post('/admin/home/delete/' . $post->post_id, $data);
        $response->assertDatabaseMissing('posts', [
            'post_id' => $post->post_id,
        ]);
    }
}
