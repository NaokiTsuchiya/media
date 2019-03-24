<?php

namespace Tests\Browser;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class HomeTest extends DuskTestCase
{

    use DatabaseMigrations;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function hasNoPost()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit('/home')
                ->assertSee('There is no your post.');
        });
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function visiblePaginate()
    {
        factory(Post::class, 15)->create([
            'user_id' => $this->user->id
        ]);

        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit('/home')
                ->assertPresent('.pagination')
                ->clickLink('Next')
                ->assertQueryStringHas('page', 2);
        });
    }
}
