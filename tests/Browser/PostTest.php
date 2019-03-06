<?php

namespace Tests\Browser;

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
                ->assertSee('this is title')
                ->assertSee('this is test post.');
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
                ->type('title', 'title is changed')
                ->type('content', 'content is changed')
                ->press('投稿')
                ->assertSee('title is changed')
                ->assertSee('content is changed');
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
                ->assertDontSee('test')
                ->assertDontSee('content is changed');
        });
    }

}
