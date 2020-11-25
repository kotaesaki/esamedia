<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Models\User;
use App\Models\Term;

class CategoryTest extends TestCase
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
        $response->get('/admin/home/category')->assertStatus(200);
    }
    public function testNewCategory()
    {
        $user = User::factory()->create();
        $category = Term::factory()->create();
        $data = [
            'name' => $category->term_name,
            'slug' => $category->term_slug,
            'parent' => 'なし',
            'description' => $category->term_description
        ];
        $response = $this->actingAs($user);
        $response->json('post', route('create_category'), $data)->assertStatus(302);
        $response->assertDatabaseHas('terms', ['term_id' => $category->term_id]);
    }
    public function testNewCategoryValidate()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user);
        $response->json('post', route('create_category'), $data = [])->assertStatus(422);
    }
    public function testShowEdit()
    {
        $user = User::factory()->create();
        $category = Term::factory()->create();
        $response = $this->actingAs($user);
        $response->get('/admin/home/category/' . $category->term_id . '/edit')->assertStatus(200);
    }
    public function testUpdateCategory()
    {
        $user = User::factory()->create();
        $category = Term::factory()->create();
        $data = [
            'name' => $category->term_name,
            'slug' => $category->term_slug,
            'parent' => 'なし',
            'description' => $category->term_description
        ];
        $response = $this->actingAs($user);
        $response->json('post', route('update_category'), $data)->assertStatus(302);
        $response->assertDatabaseHas('terms', ['term_id' => $category->term_id]);
    }
    public function testUpdateCategoryValidate()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user);
        $response->json('post', route('update_category'), $data = [])->assertStatus(422);
    }
    public function testDeleteCategory()
    {
        $user = User::factory()->create();
        $category = Term::factory()->create();
        $data = ['id' => $category->term_id];
        $response = $this->actingAs($user);
        $response->post(route('delete_category'), $data);
        $response->assertDatabaseMissing('terms', [
            'term_id' => $category->term_id,
        ]);
    }
}
