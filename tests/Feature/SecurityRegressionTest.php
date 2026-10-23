<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SecurityRegressionTest extends TestCase
{
    use RefreshDatabase;

    public function test_agent_signup_ignores_client_supplied_role(): void
    {
        Storage::fake('public');

        $this->post('/session/auth/agent/signup/create', [
            'name' => 'Agent Test',
            'email' => 'agent@test.com',
            'password' => 'password123',
            'address' => 'Jl. Test No. 1',
            'telp' => '08123456789',
            'role' => 'admin',
            'ktp' => UploadedFile::fake()->image('ktp.jpg'),
            'face' => UploadedFile::fake()->image('face.jpg'),
        ]);

        $user = User::where('email', 'agent@test.com')->first();

        $this->assertNotNull($user, 'signup should create the user');
        $this->assertSame('agent', $user->role, 'role must never come from the request');
    }

    public function test_login_is_rate_limited(): void
    {
        for ($i = 0; $i < 5; $i++) {
            $this->post('/createL', [
                'email' => 'nobody@test.com',
                'password' => 'wrong-password',
            ]);
        }

        $this->post('/createL', [
            'email' => 'nobody@test.com',
            'password' => 'wrong-password',
        ])->assertStatus(429);
    }

    public function test_logout_rejects_get_requests(): void
    {
        $this->get('/logout')->assertStatus(405);
    }

    public function test_order_pages_require_authentication(): void
    {
        $this->get('/pages/detailorder/1')->assertRedirect('/login');
        $this->post('/pages/addtoorder/1')->assertRedirect('/login');
        $this->post('/pages/already/1')->assertRedirect('/login');
    }

    public function test_pdf_preview_requires_authentication(): void
    {
        $this->get('/pdf-preview/somefile.pdf')->assertRedirect('/login');
    }

    public function test_admin_notifications_requires_authentication(): void
    {
        $this->get('/admin/notifications')->assertRedirect('/login');
    }

    public function test_favorite_pages_redirect_guests_to_login(): void
    {
        $this->get('/favorite')->assertRedirect('/login');
        $this->post('/favorite-remove/1')->assertRedirect('/login');
        $this->post('/favorite-removeall')->assertRedirect('/login');
    }
}
