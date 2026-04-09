<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class SiteAssetController extends Controller
{
    public function __invoke(string $asset): Response
    {
        $siteSetting = SiteSetting::current();

        $path = match ($asset) {
            'logo' => $siteSetting->logo_path,
            'favicon' => $siteSetting->favicon_path,
            default => null,
        };

        if (! $path || ! Storage::disk('public')->exists($path)) {
            return redirect()->away(match ($asset) {
                'logo' => asset('images/landing/logo-frametech.png'),
                default => asset('favicon.ico'),
            });
        }

        return response()->file(Storage::disk('public')->path($path));
    }
}
