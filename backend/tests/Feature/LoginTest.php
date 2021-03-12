<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\User;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    protected $user_admin;
    protected $user_editor;

    public function setUp(): void
    {
        parent::setUp();
        $this->user_admin = User::factory()->create([
            'user_status' => 'admin'
        ]);
        $this->user_editor = User::factory()->create([
            'user_status' => 'editor'
        ]);
    }
    public function testLoginView()
    {
        $response = $this->get('/admin/login');
        $response->assertStatus(200);
        $this->assertGuest();
    }
    public function testAdminLogin(): void
    {
        $response = $this->post(route('admin.login'), [
            'login_id' => $this->user_admin->login_id,
            'password' => '1234567890',
        ]);
        $response->assertStatus(302);
        $response->assertRedirect('/admin/home');
        $this->get('/admin/home')
            ->assertSeeText('Posts List')
            ->assertSeeText('New post')
            ->assertSeeText('Comments')
            ->assertSeeText('Users List')
            ->assertSeeText('User Register')
            ->assertSeeText('Category')
            ->assertSeeText('Tags');
        $this->assertAuthenticatedAs($this->user_admin);
    }
    public function testEditorLogin(): void
    {
        $response = $this->post(route('admin.login'), [
            'login_id' => $this->user_editor->login_id,
            'password' => '1234567890',
        ]);
        $response->assertStatus(302);
        $response->assertRedirect('/admin/home');
        $this->get('/admin/home')
            ->assertSeeText('Posts List')
            ->assertSeeText('New post')
            ->assertSeeText('Comments');
        $this->assertAuthenticatedAs($this->user_editor);
    }

    public function testAdminView()
    {
        $response = $this->get('/admin');
        $response->assertRedirect('/admin/login');
        $this->assertGuest();
    }
    public function testHomeView()
    {
        $response = $this->get('/admin/home');
        $response->assertRedirect('/admin/login');
        $this->assertGuest();
    }
    public function testNewView()
    {
        $response = $this->get('/admin/home/new');
        $response->assertRedirect('/admin/login');
        $this->assertGuest();
    }
    public function testCategoryView()
    {
        $response = $this->get('/admin/home/category');
        $response->assertRedirect('/admin/login');
        $this->assertGuest();
    }
    public function testTagView()
    {
        $response = $this->get('/admin/home/tag');
        $response->assertRedirect('/admin/login');
        $this->assertGuest();
    }
    public function testPublishView()
    {
        $response = $this->get('/admin/home/publish');
        $response->assertRedirect('/admin/login');
        $this->assertGuest();
    }
    public function testPrivateView()
    {
        $response = $this->get('/admin/home/private');
        $response->assertRedirect('/admin/login');
    }
    public function testCommentView()
    {
        $response = $this->get('/admin/home/comment');
        $response->assertRedirect('/admin/login');
        $this->assertGuest();
    }
    public function testRegisterView()
    {
        $response = $this->get('/admin/home/register');
        $response->assertRedirect('/admin/login');
        $this->assertGuest();
    }
    public function testUsersView()
    {
        $response = $this->get('/admin/home/users');
        $response->assertRedirect('/admin/login');
        $this->assertGuest();
    }
}
