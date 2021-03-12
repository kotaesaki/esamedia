<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Models\User;
use App\Models\Term;

class TagTest extends TestCase
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
        $response->get('/admin/home/tag')->assertStatus(200);
    }
    public function testNewTag()
    {
        $user = User::factory()->create();
        $tag = Term::factory()->create();
        $data = [
            'name' => $tag->term_name,
            'slug' => $tag->term_slug,
            'description' => $tag->term_description
        ];
        $response = $this->actingAs($user);
        $response->json('post', route('create_tag'), $data)->assertStatus(302);
        $response->assertDatabaseHas('terms', ['term_id' => $tag->term_id]);
    }
    public function testNewTagValidate()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user);
        $response->json('post', route('create_tag'), $data = [])->assertStatus(422);
    }
    public function testShowEdit()
    {
        $user = User::factory()->create();
        $tag = Term::factory()->create();
        $response = $this->actingAs($user);
        $response->get('/admin/home/tag/' . $tag->term_id . '/edit')->assertStatus(200);
    }
    public function testUpdateTag()
    {
        $user = User::factory()->create();
        $tag = Term::factory()->create();
        $data = [
            'name' => $tag->term_name,
            'slug' => $tag->term_slug,
            'description' => $tag->term_description
        ];
        $response = $this->actingAs($user);
        $response->json('post', route('update_tag'), $data)->assertStatus(302);
        $response->assertDatabaseHas('terms', ['term_id' => $tag->term_id]);
    }
    public function testUpdateTagValidate()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user);
        $response->json('post', route('update_tag'), $data = [])->assertStatus(422);
    }
    public function testDeleteCategory()
    {
        $user = User::factory()->create();
        $tag = Term::factory()->create();
        $data = ['id' => $tag->term_id];
        $response = $this->actingAs($user);
        $response->post(route('delete_tag'), $data);
        $response->assertDatabaseMissing('terms', [
            'term_id' => $tag->term_id,
        ]);
    }
}
