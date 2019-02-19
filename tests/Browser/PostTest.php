<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

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
                    ->assertPathIs('/home');
        });
    }
}
