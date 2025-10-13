<?php

namespace Tests\Feature\Admin\Testimonials;

use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
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
        $response = $this->get(route('admin.testimonials'));

        $response->assertRedirect(route('login'));
    }

    public function test_displays_testimonials_page(): void
    {
        $response = $this->actingAs($this->user)
            ->get(route('admin.testimonials'));

        $response->assertOk();
        $response->assertSee('Testimonials');
        $response->assertSee('Manage client testimonials and reviews');
    }

    public function test_displays_testimonials_list(): void
    {
        app()->setLocale('de');

        $testimonial = Testimonial::factory()->create([
            'client_name' => 'John Doe',
            'content' => ['de' => 'Excellent service', 'ar' => 'خدمة ممتازة'],
            'rating' => 5,
            'is_active' => true,
        ]);

        $response = $this->actingAs($this->user)
            ->get(route('admin.testimonials'));

        $response->assertOk();
        $response->assertSee('John Doe');
        $response->assertSee('Excellent service');
    }

    public function test_can_create_testimonial(): void
    {
        Storage::fake('public');

        $this->actingAs($this->user);

        \Livewire\Livewire::test(\App\Livewire\Admin\Testimonials\Index::class)
            ->set('client_name', 'Jane Smith')
            ->set('content.de', 'Great experience')
            ->set('content.ar', 'تجربة رائعة')
            ->set('rating', 5)
            ->set('order', 1)
            ->set('is_active', true)
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('testimonials', [
            'client_name' => 'Jane Smith',
            'rating' => 5,
            'order' => 1,
            'is_active' => true,
        ]);
    }

    public function test_can_update_testimonial(): void
    {
        $testimonial = Testimonial::factory()->create([
            'client_name' => 'Original Name',
            'content' => ['de' => 'Original content', 'ar' => 'محتوى أصلي'],
            'rating' => 3,
        ]);

        $this->actingAs($this->user);

        \Livewire\Livewire::test(\App\Livewire\Admin\Testimonials\Index::class)
            ->set('editingId', $testimonial->id)
            ->set('client_name', 'Updated Name')
            ->set('content.de', 'Updated content')
            ->set('content.ar', 'محتوى محدث')
            ->set('rating', 5)
            ->set('order', $testimonial->order)
            ->set('is_active', $testimonial->is_active)
            ->call('update')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('testimonials', [
            'id' => $testimonial->id,
            'client_name' => 'Updated Name',
            'rating' => 5,
        ]);
    }

    public function test_can_toggle_testimonial_active_status(): void
    {
        $testimonial = Testimonial::factory()->create([
            'is_active' => true,
        ]);

        $this->actingAs($this->user);

        \Livewire\Livewire::test(\App\Livewire\Admin\Testimonials\Index::class)
            ->call('toggleActive', $testimonial->id);

        $this->assertDatabaseHas('testimonials', [
            'id' => $testimonial->id,
            'is_active' => false,
        ]);
    }

    public function test_can_delete_testimonial(): void
    {
        $testimonial = Testimonial::factory()->create();

        $this->actingAs($this->user);

        \Livewire\Livewire::test(\App\Livewire\Admin\Testimonials\Index::class)
            ->set('deletingId', $testimonial->id)
            ->call('delete');

        $this->assertDatabaseMissing('testimonials', [
            'id' => $testimonial->id,
        ]);
    }

    public function test_validates_required_fields_on_create(): void
    {
        $this->actingAs($this->user);

        \Livewire\Livewire::test(\App\Livewire\Admin\Testimonials\Index::class)
            ->set('client_name', '')
            ->set('content.de', '')
            ->call('save')
            ->assertHasErrors(['client_name', 'content.de']);
    }

    public function test_validates_rating_range(): void
    {
        $this->actingAs($this->user);

        \Livewire\Livewire::test(\App\Livewire\Admin\Testimonials\Index::class)
            ->set('client_name', 'Test Client')
            ->set('content.de', 'Test content')
            ->set('rating', 6)
            ->set('order', 1)
            ->call('save')
            ->assertHasErrors(['rating']);
    }

    public function test_validates_avatar_file_type(): void
    {
        Storage::fake('public');

        $this->actingAs($this->user);

        $invalidFile = UploadedFile::fake()->create('document.pdf', 100);

        \Livewire\Livewire::test(\App\Livewire\Admin\Testimonials\Index::class)
            ->set('client_name', 'Test Client')
            ->set('content.de', 'Test content')
            ->set('rating', 5)
            ->set('order', 1)
            ->set('avatar', $invalidFile)
            ->call('save')
            ->assertHasErrors(['avatar']);
    }

    public function test_displays_empty_state_when_no_testimonials(): void
    {
        $response = $this->actingAs($this->user)
            ->get(route('admin.testimonials'));

        $response->assertOk();
        $response->assertSee('No testimonials yet');
        $response->assertSee('Create your first testimonial');
    }
}
