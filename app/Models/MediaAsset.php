<?php

namespace App\Models;

use Database\Factories\MediaAssetFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class MediaAsset extends Model
{
    /** @use HasFactory<MediaAssetFactory> */
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'alt_text',
        'file_path',
        'disk',
        'mime_type',
        'file_size',
    ];

    public function publicUrl(): string
    {
        return Storage::disk($this->disk)->url($this->file_path);
    }
}
