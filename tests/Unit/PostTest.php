<?php

namespace Tests\Unit;

use App\Post;
use App\User;
use Media\Post\Domain\PostId;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @test
     */
    public function create()
    {

        $user = factory(User::class)->create([
            'id' => 1,
            'name' => 'test',
            'email' => 'test@example.com'
        ]);

        $user->posts()->create([
            'id' => (new PostId())->getValue(),
            'title' => 'this is test',
            'content' => 'this is test content'
        ]);

        $post = $user->posts()->first();

        $this->assertSame($post->title, 'this is test');
        $this->assertSame($post->content, 'this is test content');
    }
}
