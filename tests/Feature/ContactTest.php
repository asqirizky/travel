<?php

use Inertia\Testing\AssertableInertia as Assert;

test('the planning page is shared with the configured whatsapp number', function () {
    config()->set('services.whatsapp.number', '6281216904379');

    $this->get(route('contact'))
        ->assertSuccessful()
        ->assertInertia(fn (Assert $page) => $page
            ->component('public/Contact')
            ->where('whatsappNumber', '6281216904379'));
});
