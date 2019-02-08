<?php

namespace Tests\Unit;

use App\Post;
use App\User;
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

        factory(User::class)->create([
            'id' => 1,
            'name' => 'test',
            'email' => 'test@example.com'
        ]);


        factory(Post::class)->create([
            'user_id' => 1
        ]);

        $this->assertDatabaseHas('posts', [
            'user_id' => 1
        ]);

    }
}
