<?php

namespace Tests\Feature\Admin\ConsultationRequests;

use App\Models\ConsultationRequest;
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
        $response = $this->get(route('admin.consultation-requests'));

        $response->assertRedirect(route('login'));
    }

    public function test_displays_consultation_requests_page(): void
    {
        $response = $this->actingAs($this->user)
            ->get(route('admin.consultation-requests'));

        $response->assertOk();
        $response->assertSee('Consultation Requests');
        $response->assertSee('Manage and track client consultation requests');
    }

    public function test_displays_requests_list(): void
    {
        $request = ConsultationRequest::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'status' => 'pending',
        ]);

        $response = $this->actingAs($this->user)
            ->get(route('admin.consultation-requests'));

        $response->assertOk();
        $response->assertSee('John Doe');
        $response->assertSee('john@example.com');
    }

    public function test_displays_statistics(): void
    {
        ConsultationRequest::factory()->create(['status' => 'pending']);
        ConsultationRequest::factory()->create(['status' => 'confirmed']);
        ConsultationRequest::factory()->create(['status' => 'completed']);
        ConsultationRequest::factory()->create(['status' => 'cancelled']);

        $response = $this->actingAs($this->user)
            ->get(route('admin.consultation-requests'));

        $response->assertOk();
        $response->assertSee('Total');
        $response->assertSee('Pending');
        $response->assertSee('Confirmed');
        $response->assertSee('Completed');
        $response->assertSee('Cancelled');
    }

    public function test_can_update_request_status(): void
    {
        $request = ConsultationRequest::factory()->create(['status' => 'pending']);

        $this->actingAs($this->user);

        \Livewire\Livewire::test(\App\Livewire\Admin\ConsultationRequests\Index::class)
            ->call('viewDetails', $request->id)
            ->set('newStatus', 'confirmed')
            ->call('saveStatus');

        $this->assertDatabaseHas('consultation_requests', [
            'id' => $request->id,
            'status' => 'confirmed',
        ]);
    }

    public function test_can_view_request_details(): void
    {
        $request = ConsultationRequest::factory()->create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'current_situation' => 'Need retirement planning',
            'specific_goals' => 'Maximize retirement savings',
        ]);

        $this->actingAs($this->user);

        \Livewire\Livewire::test(\App\Livewire\Admin\ConsultationRequests\Index::class)
            ->call('viewDetails', $request->id)
            ->assertSet('viewingId', $request->id)
            ->assertSet('showDetailModal', true);
    }

    public function test_can_filter_by_status(): void
    {
        ConsultationRequest::factory()->create(['status' => 'pending', 'name' => 'Pending User']);
        ConsultationRequest::factory()->create(['status' => 'confirmed', 'name' => 'Confirmed User']);

        $this->actingAs($this->user);

        $component = \Livewire\Livewire::test(\App\Livewire\Admin\ConsultationRequests\Index::class)
            ->call('setFilter', 'pending')
            ->assertSet('statusFilter', 'pending');

        // Check that only pending requests are in the filtered results
        $requests = $component->get('requests');
        $this->assertTrue($requests->every(fn ($r) => $r->status === 'pending'));
    }

    public function test_displays_empty_state_when_no_requests(): void
    {
        $response = $this->actingAs($this->user)
            ->get(route('admin.consultation-requests'));

        $response->assertOk();
        $response->assertSee('No consultation requests found');
    }

    public function test_displays_financial_topics_as_badges(): void
    {
        $request = ConsultationRequest::factory()->create([
            'financial_topics' => ['retirement', 'investment', 'insurance'],
        ]);

        $response = $this->actingAs($this->user)
            ->get(route('admin.consultation-requests'));

        $response->assertOk();
        $response->assertSee('Retirement');
        $response->assertSee('Investment');
        $response->assertSee('Insurance');
    }

    public function test_status_colors_are_applied_correctly(): void
    {
        $this->actingAs($this->user);

        $component = new \App\Livewire\Admin\ConsultationRequests\Index;

        $this->assertEquals('yellow', $component->getStatusColor('pending'));
        $this->assertEquals('blue', $component->getStatusColor('confirmed'));
        $this->assertEquals('green', $component->getStatusColor('completed'));
        $this->assertEquals('red', $component->getStatusColor('cancelled'));
    }
}
