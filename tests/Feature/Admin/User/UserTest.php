<?php

namespace Tests\Feature\Admin\User;

use App\Enums\UserGender;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        Admin::factory()->create();
        User::factory()->create();

    }

    public function test_admin_can_see_all_users(): void
    {
        $admin = Admin::first();
        $response = $this->actingAs($admin)->get(route('admin.users.index'));

        $response->assertStatus(200);
        $response->assertSee(['First Name', 'Last Name', 'Phone Number', 'National Code', 'Gender', 'Image', 'Email']);
    }

    public function test_admin_can_see_a_user(): void
    {
        $admin = Admin::first();
        $user = User::first();

        $response = $this->actingAs($admin)->get(route('admin.users.show', $user));

        $response->assertStatus(200);
        $response->assertSee([$user->name, $user->email, $user->national_code]);
        $response->assertSee('User Info');
    }

    public function test_admin_can_delete_a_user(): void
    {
        $admin = Admin::first();
        $user = User::first();

        $response = $this->actingAs($admin)->delete(route('admin.users.destroy', $user));

        $response->assertStatus(302);

        $this->assertDatabaseMissing((new User())->getTable(), [
            'id'                => $user->id,
            'email'             => $user->email,
            'name'              => $user->name,
            'national_code'     => $user->national_code,
        ]);
    }

    public function test_admin_can_create_a_user(): void
    {
        $admin = Admin::first();

        $response = $this->actingAs($admin)->post(route('admin.users.store'),[
            'name'                  => 'foo',
            'lastname'              => 'bar',
            'phonenumber'           => '09172525145',
            'national_code'         => '2283697415',
            'gender'                => fake()->randomElement(UserGender::values()),
            'email'                 => fake()->unique()->safeEmail(),
            'email_verified_at'     => now(),
            'password'              => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas((new User())->getTable(), [
            'name'              => 'foo',
            'lastname'          => 'bar',
            'national_code'     => '2283697415',
            'phonenumber'       => '09172525145',

        ]);
    }

    public function test_admin_can_update_a_user(): void
    {
        $admin = Admin::first();
        $user = User::first();

        $response = $this->actingAs($admin)->put(route('admin.users.update',$user),[
            'name'                  => 'foo',
            'lastname'              => 'bar',
            'phonenumber'           => '09172525145',
            'national_code'         => '2283697415',
            'gender'                => fake()->randomElement(UserGender::values()),
            'email'                 => fake()->unique()->safeEmail(),
            'email_verified_at'     => now(),
            'password'              => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas((new User())->getTable(), [
            'name'              => 'foo',
            'lastname'          => 'bar',
            'national_code'     => '2283697415',
            'phonenumber'       => '09172525145',

        ]);
    }
}
