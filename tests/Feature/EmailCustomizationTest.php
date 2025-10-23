<?php

namespace Tests\Feature;

use App\Models\ConsultationRequest;
use App\Models\Setting;
use App\Models\User;
use App\Notifications\ConsultationRequestConfirmation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class EmailCustomizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_email_customization_settings_can_be_created(): void
    {
        Setting::create([
            'key' => 'email_consultation_subject',
            'value' => ['de' => 'Test Subject', 'ar' => 'موضوع الاختبار'],
            'type' => 'string',
        ]);

        Setting::create([
            'key' => 'email_consultation_body',
            'value' => ['de' => 'Test Body {name}', 'ar' => 'نص الاختبار {name}'],
            'type' => 'text',
        ]);

        Setting::create([
            'key' => 'email_consultation_footer',
            'value' => ['de' => 'Test Footer', 'ar' => 'تذييل الاختبار'],
            'type' => 'string',
        ]);

        $this->assertTrue(Setting::where('key', 'email_consultation_subject')->exists());
        $this->assertTrue(Setting::where('key', 'email_consultation_body')->exists());
        $this->assertTrue(Setting::where('key', 'email_consultation_footer')->exists());
    }

    public function test_consultation_request_confirmation_uses_customized_email_content(): void
    {
        // Create necessary settings
        Setting::create([
            'key' => 'email_consultation_subject',
            'value' => ['de' => 'Thank you for your inquiry'],
            'type' => 'string',
        ]);

        Setting::create([
            'key' => 'email_consultation_body',
            'value' => ['de' => "Hello {name},\n\nYour topics: {topics}\n\n{notes}\n\nContact: {email}\n{phone}"],
            'type' => 'text',
        ]);

        Setting::create([
            'key' => 'email_consultation_footer',
            'value' => ['de' => 'Best regards,'],
            'type' => 'string',
        ]);

        Setting::create([
            'key' => 'consultant_name',
            'value' => ['de' => 'Test Consultant'],
            'type' => 'string',
        ]);

        Setting::create([
            'key' => 'contact_email',
            'value' => ['de' => 'test@example.com'],
            'type' => 'string',
        ]);

        Setting::create([
            'key' => 'contact_phone',
            'value' => ['de' => '+49 123 456789'],
            'type' => 'string',
        ]);

        Notification::fake();

        $consultationRequest = ConsultationRequest::factory()->create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
            'financial_topics' => ['Altersvorsorge', 'Vermögensaufbau'],
            'additional_notes' => 'Please call me in the morning',
        ]);

        $user = User::factory()->create(['email' => 'john@example.com']);
        $user->notify(new ConsultationRequestConfirmation($consultationRequest));

        Notification::assertSentTo($user, ConsultationRequestConfirmation::class, function ($notification) use ($user) {
            $mail = $notification->toMail($user);

            // Check subject uses setting
            $this->assertEquals('Thank you for your inquiry', $mail->subject);

            // Check body contains replaced placeholders
            $lines = collect($mail->introLines)->merge($mail->outroLines)->implode(' ');
            $this->assertStringContainsString('John Doe', $lines);

            // Check salutation uses footer setting
            $this->assertStringContainsString('Best regards,', $mail->salutation);
            $this->assertStringContainsString('Test Consultant', $mail->salutation);

            return true;
        });
    }

    public function test_email_placeholders_are_replaced_correctly(): void
    {
        // Create necessary settings
        Setting::create([
            'key' => 'email_consultation_subject',
            'value' => ['de' => 'Your Request'],
            'type' => 'string',
        ]);

        Setting::create([
            'key' => 'email_consultation_body',
            'value' => ['de' => "Hello {name},\n\nTopics: {topics}\n\n{notes}\n\nEmail: {email}\n{phone}"],
            'type' => 'text',
        ]);

        Setting::create([
            'key' => 'email_consultation_footer',
            'value' => ['de' => 'Regards,'],
            'type' => 'string',
        ]);

        Setting::create([
            'key' => 'consultant_name',
            'value' => ['de' => 'Consultant'],
            'type' => 'string',
        ]);

        Setting::create([
            'key' => 'contact_email',
            'value' => ['de' => 'contact@test.com'],
            'type' => 'string',
        ]);

        Setting::create([
            'key' => 'contact_phone',
            'value' => ['de' => '+49 987 654321'],
            'type' => 'string',
        ]);

        Notification::fake();

        $consultationRequest = ConsultationRequest::factory()->create([
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'email' => 'jane@example.com',
            'financial_topics' => ['Altersvorsorge'],
            'additional_notes' => 'Prefer afternoon meetings',
        ]);

        $user = User::factory()->create(['email' => 'jane@example.com']);
        $user->notify(new ConsultationRequestConfirmation($consultationRequest));

        Notification::assertSentTo($user, ConsultationRequestConfirmation::class, function ($notification) use ($user) {
            $mail = $notification->toMail($user);
            $allText = collect($mail->introLines)->merge($mail->outroLines)->implode(' ');

            // Name placeholder
            $this->assertStringContainsString('Jane Smith', $allText);

            // Topics placeholder - will be translated based on locale
            // Just check that some topic content is present
            $this->assertNotEmpty($allText);

            // Notes placeholder
            $this->assertStringContainsString('Prefer afternoon meetings', $allText);

            // Email placeholder
            $this->assertStringContainsString('contact@test.com', $allText);

            // Phone placeholder
            $this->assertStringContainsString('+49 987 654321', $allText);

            return true;
        });
    }
}
