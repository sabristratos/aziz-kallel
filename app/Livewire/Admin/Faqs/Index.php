<?php

namespace App\Livewire\Admin\Faqs;

use App\Models\Faq;
use Flux\Flux;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Index extends Component
{
    public bool $showCreateModal = false;

    public bool $showEditModal = false;

    public bool $showDeleteModal = false;

    public ?int $editingId = null;

    public ?int $deletingId = null;

    public array $question = ['de' => '', 'ar' => ''];

    public array $answer = ['de' => '', 'ar' => ''];

    public bool $is_active = true;

    public int $order = 0;

    #[Computed]
    public function faqs()
    {
        return Faq::query()
            ->orderBy('order')
            ->orderByDesc('created_at')
            ->get();
    }

    public function openCreateModal(): void
    {
        $this->reset(['question', 'answer', 'is_active', 'order']);
        $this->is_active = true;
        $this->order = Faq::max('order') + 1;
        $this->showCreateModal = true;
    }

    public function openEditModal(int $id): void
    {
        $faq = Faq::findOrFail($id);

        $this->editingId = $id;
        $this->question = $faq->getTranslations('question');
        $this->answer = $faq->getTranslations('answer');
        $this->is_active = $faq->is_active;
        $this->order = $faq->order;

        $this->showEditModal = true;
    }

    public function save(): void
    {
        $this->validate([
            'question.de' => 'required|string',
            'question.ar' => 'nullable|string',
            'answer.de' => 'required|string',
            'answer.ar' => 'nullable|string',
            'is_active' => 'boolean',
            'order' => 'required|integer|min:0',
        ]);

        Faq::create([
            'question' => $this->question,
            'answer' => $this->answer,
            'is_active' => $this->is_active,
            'order' => $this->order,
        ]);

        $this->showCreateModal = false;
        $this->reset(['question', 'answer', 'is_active', 'order']);

        Flux::toast(variant: 'success', text: __('FAQ created successfully'));
    }

    public function update(): void
    {
        $this->validate([
            'question.de' => 'required|string',
            'question.ar' => 'nullable|string',
            'answer.de' => 'required|string',
            'answer.ar' => 'nullable|string',
            'is_active' => 'boolean',
            'order' => 'required|integer|min:0',
        ]);

        $faq = Faq::findOrFail($this->editingId);

        $faq->update([
            'question' => $this->question,
            'answer' => $this->answer,
            'is_active' => $this->is_active,
            'order' => $this->order,
        ]);

        $this->showEditModal = false;
        $this->reset(['editingId', 'question', 'answer', 'is_active', 'order']);

        Flux::toast(variant: 'success', text: __('FAQ updated successfully'));
    }

    public function toggleActive(int $id): void
    {
        $faq = Faq::findOrFail($id);
        $faq->update(['is_active' => ! $faq->is_active]);
    }

    public function confirmDelete(int $id): void
    {
        $this->deletingId = $id;
        $this->showDeleteModal = true;
    }

    public function delete(): void
    {
        Faq::findOrFail($this->deletingId)->delete();

        $this->showDeleteModal = false;
        $this->deletingId = null;

        Flux::toast(variant: 'success', text: __('FAQ deleted successfully'));
    }

    public function moveUp(int $id): void
    {
        $faq = Faq::findOrFail($id);
        $previousFaq = Faq::where('order', '<', $faq->order)
            ->orderBy('order', 'desc')
            ->first();

        if ($previousFaq) {
            $tempOrder = $faq->order;
            $faq->update(['order' => $previousFaq->order]);
            $previousFaq->update(['order' => $tempOrder]);
        }
    }

    public function moveDown(int $id): void
    {
        $faq = Faq::findOrFail($id);
        $nextFaq = Faq::where('order', '>', $faq->order)
            ->orderBy('order', 'asc')
            ->first();

        if ($nextFaq) {
            $tempOrder = $faq->order;
            $faq->update(['order' => $nextFaq->order]);
            $nextFaq->update(['order' => $tempOrder]);
        }
    }

    public function render()
    {
        return view('livewire.admin.faqs.index')
            ->layout('components.layouts.app', [
                'title' => __('FAQs'),
            ]);
    }
}
