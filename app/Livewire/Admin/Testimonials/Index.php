<?php

namespace App\Livewire\Admin\Testimonials;

use App\Models\Testimonial;
use Flux\Flux;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    public bool $showCreateModal = false;

    public bool $showEditModal = false;

    public bool $showDeleteModal = false;

    public ?int $editingId = null;

    public ?int $deletingId = null;

    public string $client_name = '';

    public array $content = ['de' => '', 'ar' => ''];

    public int $rating = 5;

    public bool $is_active = true;

    public int $order = 0;

    public $avatar;

    #[Computed]
    public function testimonials()
    {
        return Testimonial::query()
            ->orderBy('order')
            ->orderByDesc('created_at')
            ->get();
    }

    public function openCreateModal(): void
    {
        $this->reset(['client_name', 'content', 'rating', 'is_active', 'order', 'avatar']);
        $this->rating = 5;
        $this->is_active = true;
        $this->order = Testimonial::max('order') + 1;
        $this->showCreateModal = true;
    }

    public function openEditModal(int $id): void
    {
        $testimonial = Testimonial::findOrFail($id);

        $this->editingId = $id;
        $this->client_name = $testimonial->client_name;
        $this->content = $testimonial->getTranslations('content');
        $this->rating = $testimonial->rating;
        $this->is_active = $testimonial->is_active;
        $this->order = $testimonial->order;

        $this->showEditModal = true;
    }

    public function save(): void
    {
        $this->validate([
            'client_name' => 'required|string|max:255',
            'content.de' => 'required|string',
            'content.ar' => 'nullable|string',
            'rating' => 'required|integer|min:1|max:5',
            'is_active' => 'boolean',
            'order' => 'required|integer|min:0',
            'avatar' => 'nullable|image|max:2048',
        ]);

        Testimonial::create([
            'client_name' => $this->client_name,
            'content' => $this->content,
            'rating' => $this->rating,
            'is_active' => $this->is_active,
            'order' => $this->order,
        ]);

        if ($this->avatar) {
            $testimonial = Testimonial::latest()->first();
            $testimonial->addMedia($this->avatar->getRealPath())
                ->usingName($this->client_name)
                ->toMediaCollection('avatar');
        }

        $this->showCreateModal = false;
        $this->reset(['client_name', 'content', 'rating', 'is_active', 'order', 'avatar']);

        Flux::toast(variant: 'success', text: __('Testimonial created successfully'));
    }

    public function update(): void
    {
        $this->validate([
            'client_name' => 'required|string|max:255',
            'content.de' => 'required|string',
            'content.ar' => 'nullable|string',
            'rating' => 'required|integer|min:1|max:5',
            'is_active' => 'boolean',
            'order' => 'required|integer|min:0',
            'avatar' => 'nullable|image|max:2048',
        ]);

        $testimonial = Testimonial::findOrFail($this->editingId);

        $testimonial->update([
            'client_name' => $this->client_name,
            'content' => $this->content,
            'rating' => $this->rating,
            'is_active' => $this->is_active,
            'order' => $this->order,
        ]);

        if ($this->avatar) {
            $testimonial->clearMediaCollection('avatar');
            $testimonial->addMedia($this->avatar->getRealPath())
                ->usingName($this->client_name)
                ->toMediaCollection('avatar');
        }

        $this->showEditModal = false;
        $this->reset(['editingId', 'client_name', 'content', 'rating', 'is_active', 'order', 'avatar']);

        Flux::toast(variant: 'success', text: __('Testimonial updated successfully'));
    }

    public function toggleActive(int $id): void
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->update(['is_active' => ! $testimonial->is_active]);
    }

    public function confirmDelete(int $id): void
    {
        $this->deletingId = $id;
        $this->showDeleteModal = true;
    }

    public function delete(): void
    {
        Testimonial::findOrFail($this->deletingId)->delete();

        $this->showDeleteModal = false;
        $this->deletingId = null;

        Flux::toast(variant: 'success', text: __('Testimonial deleted successfully'));
    }

    public function moveUp(int $id): void
    {
        $testimonial = Testimonial::findOrFail($id);
        $previousTestimonial = Testimonial::where('order', '<', $testimonial->order)
            ->orderBy('order', 'desc')
            ->first();

        if ($previousTestimonial) {
            $tempOrder = $testimonial->order;
            $testimonial->update(['order' => $previousTestimonial->order]);
            $previousTestimonial->update(['order' => $tempOrder]);
        }
    }

    public function moveDown(int $id): void
    {
        $testimonial = Testimonial::findOrFail($id);
        $nextTestimonial = Testimonial::where('order', '>', $testimonial->order)
            ->orderBy('order', 'asc')
            ->first();

        if ($nextTestimonial) {
            $tempOrder = $testimonial->order;
            $testimonial->update(['order' => $nextTestimonial->order]);
            $nextTestimonial->update(['order' => $tempOrder]);
        }
    }

    public function render()
    {
        return view('livewire.admin.testimonials.index')
            ->layout('components.layouts.app', [
                'title' => __('Testimonials'),
            ]);
    }
}
