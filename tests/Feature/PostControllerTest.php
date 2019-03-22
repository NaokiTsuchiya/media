<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Media\Post\Domain\PostId;
use Tests\TestCase;

class PostControllerTest extends TestCase
{

    use RefreshDatabase;

    private $actor;
    private $basePath;
    private $redirectPath;
    private $encodedPostId;

    public function setUp()
    {
        parent::setUp();

        $userId = 1;

        factory(User::class)->create([
            'id' => $userId,
            'name' => 'test',
            'email' => 'test@example.com'
        ])->posts()->create([
            'title' => 'this is test',
            'content' => 'this is test content'
        ]);

        $targetPostId = User::find($userId)->posts()->first()->id;

        $this->basePath = 'posts/' . $targetPostId;
        $this->actor = factory(User::class)->create();
        $this->redirectPath = '/home';
        $this->encodedPostId = (new PostId($targetPostId))->getValue();
    }

    /**
     * @test
     * @return void
     */
    public function deleteRequestFromOtherUser(): void
    {
        $this->actingAs($this->actor)
            ->post($this->basePath . '/delete')
            ->assertRedirect($this->redirectPath);

        $this->assertDatabaseHas('posts', ['id' => $this->encodedPostId]);
    }

    /**
     * @test
     * @return void
     */
    public function updateRequestFromOtherUser(): void
    {
        $title = 'testtest';
        $content = 'testtest';

        $this->actingAs($this->actor)
            ->post(
                $this->basePath . '/update',
                [
                    'title' => $title,
                    'content' => $content
                ]
            )
            ->assertRedirect($this->redirectPath);

        $this->assertDatabaseMissing(
            'posts',
            [
                'id' => $this->encodedPostId,
                'title' => $title,
                'content' => $content
            ]
        );
    }

    /**
     * @test
     * @return void
     */
    public function visitPostEditFormWithOtherUser(): void
    {
        $this->actingAs($this->actor)
            ->get($this->basePath . '/edit')
            ->assertRedirect($this->redirectPath);
    }

}
