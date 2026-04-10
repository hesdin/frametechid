<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateLeadRequest;
use App\Models\Lead;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class LeadController extends Controller
{
    public function index(): Response
    {
        $leads = Lead::query()->latest()->get();

        return Inertia::render('cms/leads/Index', [
            'stats' => [
                'totalLeads' => $leads->count(),
                'newLeads' => $leads->where('status', Lead::STATUS_NEW)->count(),
                'qualifiedLeads' => $leads->where('status', Lead::STATUS_QUALIFIED)->count(),
            ],
            'statusOptions' => Lead::statuses(),
            'leads' => $leads->map(fn (Lead $lead): array => [
                'id' => $lead->id,
                'name' => $lead->name,
                'businessName' => $lead->business_name,
                'phoneNumber' => $lead->phone_number,
                'email' => $lead->email,
                'serviceInterest' => $lead->service_interest,
                'message' => $lead->message,
                'status' => $lead->status,
                'source' => $lead->source,
                'notes' => $lead->notes,
                'contactedAt' => $lead->contacted_at?->format('F j, Y H:i'),
                'createdAt' => $lead->created_at->diffForHumans(),
            ])->all(),
        ]);
    }

    public function edit(Lead $lead): Response
    {
        return Inertia::render('cms/leads/Edit', [
            'lead' => [
                'id' => $lead->id,
                'name' => $lead->name,
                'businessName' => $lead->business_name,
                'phoneNumber' => $lead->phone_number,
                'email' => $lead->email,
                'serviceInterest' => $lead->service_interest,
                'message' => $lead->message,
                'status' => $lead->status,
                'source' => $lead->source,
                'notes' => $lead->notes ?? '',
                'contactedAt' => $lead->contacted_at?->format('F j, Y H:i'),
            ],
            'statusOptions' => Lead::statuses(),
        ]);
    }

    public function update(UpdateLeadRequest $request, Lead $lead): RedirectResponse
    {
        $validated = $request->validated();

        $lead->fill([
            'status' => $validated['status'],
            'notes' => $validated['notes'] ?? null,
            'contacted_at' => $validated['status'] === Lead::STATUS_NEW
                ? null
                : ($lead->contacted_at ?? now()),
        ])->save();

        return to_route('cms.leads.index')
            ->with('success', 'Status lead berhasil diperbarui.');
    }

    public function destroy(Lead $lead): RedirectResponse
    {
        $lead->delete();

        return to_route('cms.leads.index')
            ->with('success', 'Lead berhasil dihapus.');
    }
}
