<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // Personal Information
            [
                'key' => 'consultant_name',
                'value' => ['de' => 'Abdelaziz Kallel'],
                'type' => 'string',
            ],
            [
                'key' => 'consultant_title',
                'value' => [
                    'de' => 'Finanzberater & Karrierecoach',
                    'ar' => 'مستشار مالي ومدرب مهني',
                ],
                'type' => 'string',
            ],
            [
                'key' => 'consultant_credentials',
                'value' => [
                    'de' => 'IHK-zertifizierter Finanzanlagenfachmann',
                    'ar' => 'مستشار مالي معتمد من IHK',
                ],
                'type' => 'string',
            ],
            [
                'key' => 'consultant_experience',
                'value' => [
                    'de' => '15+',
                    'ar' => '15+',
                ],
                'type' => 'string',
            ],
            [
                'key' => 'consultant_team_size',
                'value' => [
                    'de' => '2-Personen-Team',
                    'ar' => 'فريق من شخصين',
                ],
                'type' => 'string',
            ],
            [
                'key' => 'consultant_rating',
                'value' => [
                    'de' => '5,0/5,0 Sterne aus 118 Kundenbewertungen',
                    'ar' => '5.0/5.0 نجوم من 118 تقييم عملاء',
                ],
                'type' => 'string',
            ],

            // Contact Information
            [
                'key' => 'contact_address_street',
                'value' => ['de' => 'Berliner Str. 22'],
                'type' => 'string',
            ],
            [
                'key' => 'contact_address_city',
                'value' => ['de' => '61137 Schöneck'],
                'type' => 'string',
            ],
            [
                'key' => 'contact_phone',
                'value' => ['de' => '+49 6187 9023048'],
                'type' => 'string',
            ],
            [
                'key' => 'contact_mobile',
                'value' => ['de' => '+49 171 7421462'],
                'type' => 'string',
            ],
            [
                'key' => 'contact_email',
                'value' => ['de' => 'Abdelaziz.Kallel@dvag.de'],
                'type' => 'string',
            ],

            // Company Information
            [
                'key' => 'company_name',
                'value' => ['de' => 'Deutsche Vermögensberatung'],
                'type' => 'string',
            ],

            // Hero Section
            [
                'key' => 'hero_title',
                'value' => [
                    'de' => 'Ihr persönlicher Finanzberater in Deutschland',
                    'ar' => 'مستشارك المالي الشخصي في ألمانيا',
                ],
                'type' => 'string',
            ],
            [
                'key' => 'hero_subtitle',
                'value' => [
                    'de' => 'Professionelle Finanzberatung mit Fokus auf Ihre Wünsche und Ziele',
                    'ar' => 'استشارات مالية احترافية تركز على أهدافك ورغباتك',
                ],
                'type' => 'string',
            ],
            [
                'key' => 'hero_description',
                'value' => [
                    'de' => 'Als IHK-zertifizierter Finanzanlagenfachmann berate ich Sie seit 2009 umfassend in allen Finanzfragen. Ein Ansprechpartner für Ihre gesamte finanzielle Zukunft.',
                    'ar' => 'بصفتي مستشار مالي معتمد من IHK، أقدم لك استشارات شاملة في جميع الأمور المالية منذ عام 2009. شريك واحد لمستقبلك المالي بالكامل.',
                ],
                'type' => 'text',
            ],

            // Landing Page Settings
            [
                'key' => 'landing_headline',
                'value' => [
                    'de' => 'Kostenlose Finanzberatung vereinbaren',
                    'ar' => 'احجز استشارة مالية مجانية',
                ],
                'type' => 'string',
            ],
            [
                'key' => 'landing_lede',
                'value' => [
                    'de' => 'Professionelle Beratung für Ihre finanzielle Zukunft. Vereinbaren Sie jetzt ein unverbindliches Gespräch mit Ihrem persönlichen Finanzberater.',
                    'ar' => 'استشارة مهنية لمستقبلك المالي. احجز الآن محادثة غير ملزمة مع مستشارك المالي الشخصي.',
                ],
                'type' => 'text',
            ],
            [
                'key' => 'landing_meta_title',
                'value' => [
                    'de' => 'Kostenlose Finanzberatung | Abdelaziz Kallel - Deutsche Vermögensberatung',
                    'ar' => 'استشارة مالية مجانية | عبد العزيز قلال - الاستشارات المالية الألمانية',
                ],
                'type' => 'string',
            ],
            [
                'key' => 'landing_meta_description',
                'value' => [
                    'de' => 'Vereinbaren Sie eine kostenlose Finanzberatung mit IHK-zertifiziertem Finanzberater Abdelaziz Kallel. Unverbindlicher Termin in Schöneck oder online. ☎ +49 6187 9023048',
                    'ar' => 'احجز استشارة مالية مجانية مع المستشار المالي المعتمد عبد العزيز قلال. موعد غير ملزم في شونيك أو عبر الإنترنت.',
                ],
                'type' => 'string',
            ],

            // SEO/Meta Information
            [
                'key' => 'meta_title',
                'value' => [
                    'de' => 'Abdelaziz Kallel - Vermögensberater in Schöneck | Deutsche Vermögensberatung',
                    'ar' => 'عبد العزيز قلال - مستشار مالي في شونيك | الاستشارات المالية الألمانية',
                ],
                'type' => 'string',
            ],
            [
                'key' => 'meta_description',
                'value' => [
                    'de' => 'IHK-zertifizierter Finanzanlagenfachmann Abdelaziz Kallel berät Sie seit 2009 in Schöneck. Individuelle Finanzberatung, Anlagestrategien und Altersvorsorge. ☎ +49 6187 9023048',
                    'ar' => 'عبد العزيز قلال، مستشار مالي معتمد من IHK، يقدم لك استشارات منذ عام 2009 في شونيك. استشارات مالية فردية، استراتيجيات استثمارية وتخطيط للتقاعد. ☎ +49 6187 9023048',
                ],
                'type' => 'string',
            ],

            // Email Configuration
            [
                'key' => 'mail_mailer',
                'value' => env('MAIL_MAILER', 'smtp'),
                'type' => 'string',
            ],
            [
                'key' => 'mail_host',
                'value' => env('MAIL_HOST', 'smtp.mailtrap.io'),
                'type' => 'string',
            ],
            [
                'key' => 'mail_port',
                'value' => env('MAIL_PORT', '2525'),
                'type' => 'string',
            ],
            [
                'key' => 'mail_username',
                'value' => env('MAIL_USERNAME'),
                'type' => 'string',
            ],
            [
                'key' => 'mail_password',
                'value' => env('MAIL_PASSWORD'),
                'type' => 'string',
            ],
            [
                'key' => 'mail_encryption',
                'value' => env('MAIL_ENCRYPTION', 'tls'),
                'type' => 'string',
            ],
            [
                'key' => 'mail_from_address',
                'value' => env('MAIL_FROM_ADDRESS', 'hello@example.com'),
                'type' => 'string',
            ],
            [
                'key' => 'mail_from_name',
                'value' => env('MAIL_FROM_NAME', 'Abdelaziz Kallel'),
                'type' => 'string',
            ],

            // Image Settings (Media Library)
            [
                'key' => 'site_logo',
                'value' => null,
                'type' => 'media',
            ],
            [
                'key' => 'hero_section_image',
                'value' => null,
                'type' => 'media',
            ],
            [
                'key' => 'header_dropdown_avatar',
                'value' => null,
                'type' => 'media',
            ],
            [
                'key' => 'about_section_image',
                'value' => null,
                'type' => 'media',
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                [
                    'value' => $setting['value'],
                    'type' => $setting['type'],
                ]
            );
        }
    }
}
