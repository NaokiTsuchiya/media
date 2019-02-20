<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class HomeTest extends DuskTestCase
{

    use DatabaseMigrations;

    /**
     * @test
     * @throws \Throwable
     */
    public function visit()
    {

        factory(User::class)->create();

        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->visit('/home')
                ->assertSee('There is no your post.');
        });
    }
}
