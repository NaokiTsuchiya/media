<?php

namespace Tests\Browser;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class PostTest extends DuskTestCase
{

    use DatabaseMigrations;

    /**
     * @return void
     * @throws \Throwable
     */
    public function testCreateNewPost(): void
    {

        factory(User::class)->create();

        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->visit('/post')
                ->type('title', 'this is title')
                ->type('content', 'this is test post.')
                ->press('投稿')
                ->assertPathIs('/home')
                ->assertSee('this is title');
        });
    }

    /**
     * @return void
     * @throws \Throwable
     */
    public function testEditPost(): void
    {
        factory(User::class)
            ->create()
            ->posts()
            ->create([
                'title' => 'test',
                'content' => 'this is test post.'
            ]);

        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs(User::find(1))
                ->visit('/home')
                ->assertSee('test')
                ->clickLink('test')
                ->assertSee('test')
                ->assertSee('this is test post.')
                ->assertSee('編集')
                ->clickLink('編集')
                ->assertInputValue('title', 'test')
                ->assertInputValue('content', 'this is test post.')
                ->type('title', 'title is changed')
                ->type('content', 'content is changed')
                ->press('投稿')
                ->assertPathIs('/home')
                ->assertSee('title is changed');
        });
    }


    /**
     * @return void
     * @throws \Throwable
     */
    public function testDeletePost(): void
    {
        factory(User::class)
            ->create()
            ->posts()
            ->create([
                'title' => 'test',
                'content' => 'this is test post.'
            ]);

        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs(User::find(1))
                ->visit('/home')
                ->assertSee('test')
                ->clickLink('test')
                ->assertSee('test')
                ->assertSee('this is test post.')
                ->assertSee('削除')
                ->press('削除')
                ->assertPathIs('/home')
                ->assertDontSee('test');
        });
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function browseWithNoLoggedinUser()
    {
        $user = factory(User::class)->create();

        factory(Post::class, 15)->create([
            'user_id' => $user->id
        ]);

        $post = Post::orderBy('created_at', 'desc')->get()->first();

        $targetPath = '/' . $user->id . '/posts/' . $post->id;

        $this->browse(function (Browser $browser) use ($targetPath) {
            $browser->visit('/')
                ->assertPresent('.list-group-item')
                ->assertPresent('.pagination')
                ->clickLink('test')
                ->assertSee('test')
                ->assertSee('this is test post.')
                ->assertPathIs($targetPath);
        });
    }
}
