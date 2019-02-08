<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
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

        $this->assertDatabaseHas('users', [
            'id' => 1,
            'name' => 'test',
            'email' => 'test@example.com'
        ]);
    }
}
