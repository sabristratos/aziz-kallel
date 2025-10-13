<?php

namespace Tests\Feature\Admin\Faqs;

use App\Models\Faq;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_requires_authentication(): void
    {
        $response = $this->get(route('admin.faqs'));

        $response->assertRedirect(route('login'));
    }

    public function test_displays_faqs_page(): void
    {
        $response = $this->actingAs($this->user)
            ->get(route('admin.faqs'));

        $response->assertOk();
        $response->assertSee('FAQs');
        $response->assertSee('Manage frequently asked questions');
    }

    public function test_displays_faqs_list(): void
    {
        app()->setLocale('de');

        $faq = Faq::factory()->create([
            'question' => ['de' => 'What is this?', 'ar' => 'ما هذا؟'],
            'answer' => ['de' => 'This is an answer', 'ar' => 'هذه إجابة'],
            'is_active' => true,
        ]);

        $response = $this->actingAs($this->user)
            ->get(route('admin.faqs'));

        $response->assertOk();
        $response->assertSee('What is this?');
        $response->assertSee('This is an answer');
    }

    public function test_can_create_faq(): void
    {
        $this->actingAs($this->user);

        \Livewire\Livewire::test(\App\Livewire\Admin\Faqs\Index::class)
            ->set('question.de', 'How does it work?')
            ->set('question.ar', 'كيف يعمل؟')
            ->set('answer.de', 'It works like this')
            ->set('answer.ar', 'يعمل بهذه الطريقة')
            ->set('order', 1)
            ->set('is_active', true)
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('faqs', [
            'order' => 1,
            'is_active' => true,
        ]);
    }

    public function test_can_update_faq(): void
    {
        $faq = Faq::factory()->create([
            'question' => ['de' => 'Original question', 'ar' => 'سؤال أصلي'],
            'answer' => ['de' => 'Original answer', 'ar' => 'إجابة أصلية'],
        ]);

        $this->actingAs($this->user);

        \Livewire\Livewire::test(\App\Livewire\Admin\Faqs\Index::class)
            ->set('editingId', $faq->id)
            ->set('question.de', 'Updated question')
            ->set('question.ar', 'سؤال محدث')
            ->set('answer.de', 'Updated answer')
            ->set('answer.ar', 'إجابة محدثة')
            ->set('order', $faq->order)
            ->set('is_active', $faq->is_active)
            ->call('update')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('faqs', [
            'id' => $faq->id,
        ]);
    }

    public function test_can_toggle_faq_active_status(): void
    {
        $faq = Faq::factory()->create([
            'is_active' => true,
        ]);

        $this->actingAs($this->user);

        \Livewire\Livewire::test(\App\Livewire\Admin\Faqs\Index::class)
            ->call('toggleActive', $faq->id);

        $this->assertDatabaseHas('faqs', [
            'id' => $faq->id,
            'is_active' => false,
        ]);
    }

    public function test_can_delete_faq(): void
    {
        $faq = Faq::factory()->create();

        $this->actingAs($this->user);

        \Livewire\Livewire::test(\App\Livewire\Admin\Faqs\Index::class)
            ->set('deletingId', $faq->id)
            ->call('delete');

        $this->assertDatabaseMissing('faqs', [
            'id' => $faq->id,
        ]);
    }

    public function test_validates_required_fields_on_create(): void
    {
        $this->actingAs($this->user);

        \Livewire\Livewire::test(\App\Livewire\Admin\Faqs\Index::class)
            ->set('question.de', '')
            ->set('answer.de', '')
            ->call('save')
            ->assertHasErrors(['question.de', 'answer.de']);
    }

    public function test_displays_empty_state_when_no_faqs(): void
    {
        $response = $this->actingAs($this->user)
            ->get(route('admin.faqs'));

        $response->assertOk();
        $response->assertSee('No FAQs yet');
        $response->assertSee('Create your first FAQ');
    }

    public function test_can_reorder_faqs(): void
    {
        $faq1 = Faq::factory()->create(['order' => 1]);
        $faq2 = Faq::factory()->create(['order' => 2]);

        $this->actingAs($this->user);

        \Livewire\Livewire::test(\App\Livewire\Admin\Faqs\Index::class)
            ->call('moveDown', $faq1->id);

        $this->assertDatabaseHas('faqs', [
            'id' => $faq1->id,
            'order' => 2,
        ]);

        $this->assertDatabaseHas('faqs', [
            'id' => $faq2->id,
            'order' => 1,
        ]);
    }
}
