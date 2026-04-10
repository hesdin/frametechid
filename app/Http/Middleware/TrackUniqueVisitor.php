<?php

namespace App\Http\Middleware;

use App\Models\Visitor;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class TrackUniqueVisitor
{
    public const COOKIE_NAME = 'frametech_visitor';

    private const COOKIE_DURATION_MINUTES = 2628000;

    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->isMethod('GET') || $this->isPrefetchRequest($request) || $this->isCrawler($request)) {
            return $next($request);
        }

        $visitorToken = $request->cookie(self::COOKIE_NAME);
        $isNewVisitorToken = ! is_string($visitorToken) || ! Str::isUuid($visitorToken);

        if ($isNewVisitorToken) {
            $visitorToken = (string) Str::uuid();
        }

        $now = now();

        $visitor = Visitor::query()->firstOrCreate(
            ['visitor_token' => $visitorToken],
            [
                'first_visited_at' => $now,
                'last_visited_at' => $now,
                'last_path' => $request->path(),
                'last_ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ],
        );

        if (! $visitor->wasRecentlyCreated) {
            $visitor->forceFill([
                'last_visited_at' => $now,
                'last_path' => $request->path(),
                'last_ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ])->save();
        }

        $response = $next($request);

        if ($isNewVisitorToken) {
            $response->headers->setCookie(
                cookie(
                    self::COOKIE_NAME,
                    $visitorToken,
                    self::COOKIE_DURATION_MINUTES,
                    '/',
                    null,
                    $request->isSecure(),
                    true,
                    false,
                    'lax',
                ),
            );
        }

        return $response;
    }

    private function isPrefetchRequest(Request $request): bool
    {
        return in_array(strtolower((string) $request->header('Purpose')), ['prefetch', 'preview'], true)
            || strtolower((string) $request->header('X-Moz')) === 'prefetch';
    }

    private function isCrawler(Request $request): bool
    {
        $userAgent = strtolower((string) $request->userAgent());

        if ($userAgent === '') {
            return false;
        }

        return Str::contains($userAgent, ['bot', 'crawler', 'spider', 'slurp', 'curl']);
    }
}
