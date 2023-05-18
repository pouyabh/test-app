<?php

namespace Tests\Feature\Admin\Comment;

use App\Enums\CommentStatus;
use App\Models\Admin;
use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        Admin::factory()->create();
        Comment::factory()->create();

    }

    public function test_can_see_all_comments(): void
    {
        $admin = Admin::first();
        $response = $this->actingAs($admin)->get(route('admin.comments.index'));

        $response->assertStatus(200);
    }

    public function test_can_see_a_comment(): void
    {
        $admin = Admin::first();
        $comment = Comment::factory()->create();

        $response = $this->actingAs($admin)->get(route('admin.comments.show', $comment));

        $response->assertStatus(200);
        $response->assertSee([$comment->text]);
    }

    public function test_can_change_status_a_comment(): void
    {
        $admin = Admin::first();
        $comment = Comment::first();

        $response = $this->actingAs($admin)->put(route('admin.comments.update', $comment), [
            'status' => CommentStatus::INACTIVE->value
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas((new Comment())->getTable(), [
            'id'        => $comment->id,
            'status'    => CommentStatus::INACTIVE->value,
        ]);
    }

    public function test_can_reply_to_comment(): void
    {
        $admin = Admin::first();
        $comment = Comment::first();

        $response = $this->actingAs($admin)->post(route('admin.comments.reply', $comment), [
            'text' => 'foobar'
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas((new Comment())->getTable(), [
            'text' => 'foobar',
            'admin_id' => $admin->id
        ]);

        $this->assertCount(1, $comment->replies);
    }
}
