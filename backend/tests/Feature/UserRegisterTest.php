<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Models\User;


class UserRegisterTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $user = User::factory()->create([
            'user_status' => 'admin'
        ]);
        $response = $this->actingAs($user);
        $response->get('/admin/home/register')->assertStatus(200);
    }
    public function testRegisterAdmin()
    {
        $user = User::factory()->create([
            'user_status' => 'admin'
        ]);
        $register_user = User::factory()->create([
            'user_status' => 'admin'
        ]);
        $data = [
            'name' => $register_user->name,
            'login_id' => 'RegisterAdminTest',
            'email' => 'RegisterAdminTest@example.com',
            'password' =>  $register_user->password,
            'password_confirmation' =>  $register_user->password,
            'user_status' => $register_user->user_status
        ];
        $response = $this->actingAs($user);
        $response->json('post', route('create_register'), $data)
            ->assertStatus(302);
    }
    public function testRegisterEditor()
    {
        $user = User::factory()->create([
            'user_status' => 'admin'
        ]);
        $register_user = User::factory()->create([
            'user_status' => 'editor'
        ]);
        $data = [
            'name' => $register_user->name,
            'login_id' => 'RegisterEditorTest',
            'email' => 'RegisterEditorTest@example.com',
            'password' =>  $register_user->password,
            'password_confirmation' =>  $register_user->password,
            'user_status' => $register_user->user_status
        ];
        $response = $this->actingAs($user);
        $response->json('post', route('create_register'), $data)
            ->assertStatus(302);
    }
    public function testRegisterValidate()
    {
        $user = User::factory()->create([
            'user_status' => 'admin'
        ]);
        $response = $this->actingAs($user);
        $response->json('post', route('create_register'), $data = [])
            ->assertStatus(422);
    }
}
