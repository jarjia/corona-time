<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LanguageTest extends TestCase
{
    use RefreshDatabase;

    public function test_language_should_save_new_language_request_in_session_and_set_app_locale_to_it() 
    {
        $newLocale = 'ka';
        $response = $this->from("{route}")->get(route('lang', ['locale' => $newLocale]));

        $response->assertRedirect("{route}");
    }

    public function test_language_should_change_according_to_session_if_it_exists() 
    {
        $newSession = 'ka';
        $session = $this->withSession(['my_locale' => $newSession])
        ->from("{route}")->get(route('lang', ['locale' => $newSession]));

        $session->assertRedirect("{route}");
    }
}
