<?php

namespace App\Livewire\Admin\ConsultationRequests;

use App\Models\ConsultationRequest;
use Flux\Flux;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Index extends Component
{
    public bool $showDetailModal = false;

    public ?int $viewingId = null;

    public string $statusFilter = 'all';

    public string $newStatus = '';

    public function viewDetails(int $id): void
    {
        $request = ConsultationRequest::findOrFail($id);
        $this->viewingId = $id;
        $this->newStatus = $request->status;
        $this->showDetailModal = true;
    }

    public function saveStatus(): void
    {
        $request = ConsultationRequest::findOrFail($this->viewingId);
        $request->update(['status' => $this->newStatus]);

        Flux::toast(variant: 'success', text: __('Status updated successfully'));
    }

    public function setFilter(string $status): void
    {
        $this->statusFilter = $status;
    }

    #[Computed]
    public function requests()
    {
        return ConsultationRequest::query()
            ->when($this->statusFilter !== 'all', function ($query) {
                $query->where('status', $this->statusFilter);
            })
            ->latest()
            ->get();
    }

    #[Computed]
    public function viewingRequest()
    {
        if (! $this->viewingId) {
            return null;
        }

        return ConsultationRequest::find($this->viewingId);
    }

    #[Computed]
    public function stats()
    {
        return [
            'total' => ConsultationRequest::count(),
            'pending' => ConsultationRequest::pending()->count(),
            'confirmed' => ConsultationRequest::confirmed()->count(),
            'completed' => ConsultationRequest::completed()->count(),
            'cancelled' => ConsultationRequest::cancelled()->count(),
        ];
    }

    public function getStatusColor(string $status): string
    {
        return match ($status) {
            'pending' => 'yellow',
            'confirmed' => 'blue',
            'completed' => 'green',
            'cancelled' => 'red',
            default => 'zinc',
        };
    }

    public function render()
    {
        return view('livewire.admin.consultation-requests.index')
            ->layout('components.layouts.app', [
                'title' => __('Consultation Requests'),
            ]);
    }
}
