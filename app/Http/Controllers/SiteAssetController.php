<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SiteAssetController extends Controller
{
    public function __invoke(string $asset): Response|StreamedResponse
    {
        $siteSetting = SiteSetting::current();

        $path = match ($asset) {
            'logo' => $siteSetting->logo_path,
            'favicon' => $siteSetting->favicon_path,
            default => null,
        };

        if (! $path || ! Storage::disk('public')->exists($path)) {
            return $this->fallbackAssetResponse($asset);
        }

        return response()->file(
            Storage::disk('public')->path($path),
            $this->assetHeaders($asset),
        );
    }

    /**
     * @return array<string, string>
     */
    private function assetHeaders(string $asset): array
    {
        if ($asset !== 'favicon') {
            return [];
        }

        return [
            'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
            'Pragma' => 'no-cache',
            'Expires' => '0',
        ];
    }

    private function fallbackAssetResponse(string $asset): Response|StreamedResponse
    {
        $path = match ($asset) {
            'logo' => public_path('images/landing/logo-frametech.png'),
            default => public_path('favicon.ico'),
        };

        if (! file_exists($path)) {
            abort(404);
        }

        return response()->file($path, $this->assetHeaders($asset));
    }
}
