<?php

use App\Http\Middleware\TrackUniqueVisitor;
use App\Models\Visitor;
use Illuminate\Support\Str;

test('new public visitors receive a tracking cookie and are stored once', function () {
    $this->get(route('home'))
        ->assertOk()
        ->assertCookie(TrackUniqueVisitor::COOKIE_NAME);

    expect(Visitor::query()->count())->toBe(1);
});

test('refreshes do not increase unique visitor count for the same visitor token', function () {
    $visitorToken = (string) Str::uuid();

    $this->withCookie(TrackUniqueVisitor::COOKIE_NAME, $visitorToken)
        ->get(route('home'))
        ->assertOk();

    $this->withCookie(TrackUniqueVisitor::COOKIE_NAME, $visitorToken)
        ->get(route('home'))
        ->assertOk();

    $this->withCookie(TrackUniqueVisitor::COOKIE_NAME, $visitorToken)
        ->get(route('services'))
        ->assertOk();

    expect(Visitor::query()->count())->toBe(1);
    expect(Visitor::query()->where('visitor_token', $visitorToken)->exists())->toBeTrue();
});

test('crawler requests are ignored from unique visitor stats', function () {
    $this->withHeader('User-Agent', 'Googlebot/2.1')
        ->get(route('home'))
        ->assertOk();

    expect(Visitor::query()->count())->toBe(0);
});
