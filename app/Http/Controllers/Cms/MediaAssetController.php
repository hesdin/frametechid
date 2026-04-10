<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMediaAssetRequest;
use App\Http\Requests\UpdateMediaAssetRequest;
use App\Models\MediaAsset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class MediaAssetController extends Controller
{
    public function index(): Response
    {
        $mediaAssets = MediaAsset::query()->latest()->get();

        return Inertia::render('cms/media/Index', [
            'stats' => [
                'totalAssets' => $mediaAssets->count(),
                'imagesCount' => $mediaAssets->filter(fn (MediaAsset $asset): bool => str_starts_with((string) $asset->mime_type, 'image/'))->count(),
            ],
            'mediaAssets' => $mediaAssets->map(fn (MediaAsset $mediaAsset): array => [
                'id' => $mediaAsset->id,
                'title' => $mediaAsset->title,
                'altText' => $mediaAsset->alt_text,
                'filePath' => $mediaAsset->file_path,
                'url' => $mediaAsset->publicUrl(),
                'mimeType' => $mediaAsset->mime_type,
                'fileSize' => $mediaAsset->file_size,
                'createdAt' => $mediaAsset->created_at->diffForHumans(),
            ])->all(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('cms/media/Create', [
            'mediaAsset' => $this->formData(new MediaAsset),
        ]);
    }

    public function store(StoreMediaAssetRequest $request): RedirectResponse
    {
        $file = $request->file('file');

        MediaAsset::query()->create([
            'title' => $request->validated('title'),
            'alt_text' => $request->validated('alt_text'),
            'file_path' => $file->store('media-library', 'public'),
            'disk' => 'public',
            'mime_type' => $file->getMimeType(),
            'file_size' => $file->getSize(),
        ]);

        return to_route('cms.media.index')
            ->with('success', 'File media berhasil diunggah.');
    }

    public function edit(MediaAsset $mediaAsset): Response
    {
        return Inertia::render('cms/media/Edit', [
            'mediaAsset' => $this->formData($mediaAsset),
        ]);
    }

    public function update(UpdateMediaAssetRequest $request, MediaAsset $mediaAsset): RedirectResponse
    {
        $payload = [
            'title' => $request->validated('title'),
            'alt_text' => $request->validated('alt_text'),
        ];

        if ($request->hasFile('file')) {
            Storage::disk($mediaAsset->disk)->delete($mediaAsset->file_path);

            $file = $request->file('file');

            $payload['file_path'] = $file->store('media-library', 'public');
            $payload['disk'] = 'public';
            $payload['mime_type'] = $file->getMimeType();
            $payload['file_size'] = $file->getSize();
        }

        $mediaAsset->fill($payload)->save();

        return to_route('cms.media.index')
            ->with('success', 'Media asset berhasil diperbarui.');
    }

    public function destroy(MediaAsset $mediaAsset): RedirectResponse
    {
        Storage::disk($mediaAsset->disk)->delete($mediaAsset->file_path);
        $mediaAsset->delete();

        return to_route('cms.media.index')
            ->with('success', 'Media asset berhasil dihapus.');
    }

    /**
     * @return array<string, mixed>
     */
    protected function formData(MediaAsset $mediaAsset): array
    {
        return [
            'id' => $mediaAsset->id,
            'title' => $mediaAsset->title ?? '',
            'altText' => $mediaAsset->alt_text ?? '',
            'url' => $mediaAsset->exists ? $mediaAsset->publicUrl() : null,
            'mimeType' => $mediaAsset->mime_type,
            'fileSize' => $mediaAsset->file_size,
        ];
    }
}
