<?php

namespace App\Http\Controllers;

use App\Models\PortfolioItem;
use App\Models\Post;
use App\Models\PricingPlan;
use App\Models\Service;
use Carbon\CarbonImmutable;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class SitemapController extends Controller
{
    public function __invoke(): Response
    {
        $homeLastModified = collect([
            Service::query()->active()->max('updated_at'),
            PricingPlan::query()->active()->max('updated_at'),
            PortfolioItem::query()->published()->max('updated_at'),
            Post::query()->published()->max('updated_at'),
        ])
            ->filter()
            ->max();

        /** @var Collection<int, array{loc: string, lastmod: string|null, changefreq: string, priority: string}> $staticPages */
        $staticPages = collect([
            [
                'loc' => route('home'),
                'lastmod' => $this->toAtomString($homeLastModified),
                'changefreq' => 'daily',
                'priority' => '1.0',
            ],
            [
                'loc' => route('services'),
                'lastmod' => $this->toAtomString(Service::query()->active()->max('updated_at')),
                'changefreq' => 'weekly',
                'priority' => '0.9',
            ],
            [
                'loc' => route('pricing'),
                'lastmod' => $this->toAtomString(PricingPlan::query()->active()->max('updated_at')),
                'changefreq' => 'weekly',
                'priority' => '0.8',
            ],
            [
                'loc' => route('portfolio'),
                'lastmod' => $this->toAtomString(PortfolioItem::query()->published()->max('updated_at')),
                'changefreq' => 'weekly',
                'priority' => '0.9',
            ],
            [
                'loc' => route('about'),
                'lastmod' => null,
                'changefreq' => 'monthly',
                'priority' => '0.7',
            ],
            [
                'loc' => route('blog'),
                'lastmod' => $this->toAtomString(Post::query()->published()->max('updated_at')),
                'changefreq' => 'daily',
                'priority' => '0.9',
            ],
        ]);

        /** @var Collection<int, array{loc: string, lastmod: string|null, changefreq: string, priority: string}> $posts */
        $posts = Post::query()
            ->published()
            ->select(['slug', 'updated_at', 'published_at'])
            ->orderByDesc('published_at')
            ->get()
            ->map(fn (Post $post): array => [
                'loc' => route('blog.show', $post->slug),
                'lastmod' => $this->toAtomString($post->updated_at),
                'changefreq' => 'monthly',
                'priority' => '0.8',
            ]);

        return response()
            ->view('sitemap', [
                'entries' => $staticPages->concat($posts)->values(),
            ])
            ->header('Content-Type', 'application/xml; charset=UTF-8')
            ->header('Cache-Control', 'public, max-age=3600');
    }

    private function toAtomString(mixed $value): ?string
    {
        if ($value === null) {
            return null;
        }

        return CarbonImmutable::parse($value)->toAtomString();
    }
}
