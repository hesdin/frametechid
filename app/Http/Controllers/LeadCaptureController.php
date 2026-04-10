<?php

namespace App\Http\Controllers;

use App\Http\Requests\CaptureLeadRequest;
use App\Models\Lead;
use Illuminate\Http\RedirectResponse;

class LeadCaptureController extends Controller
{
    public function __invoke(CaptureLeadRequest $request): RedirectResponse
    {
        Lead::query()->create([
            ...$request->validated(),
            'status' => Lead::STATUS_NEW,
            'source' => 'website',
        ]);

        return back()->with('success', 'Permintaan konsultasi berhasil dikirim. Tim kami akan segera menghubungi Anda.');
    }
}
