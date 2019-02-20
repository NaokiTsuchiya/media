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

}
