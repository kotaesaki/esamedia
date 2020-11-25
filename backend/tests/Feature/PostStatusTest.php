<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Models\User;

class PostStatusTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetPublish()
    {
        $user = User::factory()->create([
            'user_status' => 'admin'
        ]);
        $response = $this->actingAs($user);
        $response->get(route('post_getPublish'))
            ->assertStatus(200);
    }
    public function testGetPrivate()
    {
        $user = User::factory()->create([
            'user_status' => 'admin'
        ]);
        $response = $this->actingAs($user);
        $response->get(route('post_getPrivate'))
            ->assertStatus(200);
    }
}
