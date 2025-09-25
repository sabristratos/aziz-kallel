<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
                'type' => 'string'
            ],
            [
                'key' => 'consultant_title',
                'value' => ['de' => 'Vermögensberater'],
                'type' => 'string'
            ],
            [
                'key' => 'consultant_credentials',
                'value' => ['de' => 'IHK-zertifizierter Finanzanlagenfachmann'],
                'type' => 'string'
            ],
            [
                'key' => 'consultant_experience',
                'value' => ['de' => 'Seit 2009'],
                'type' => 'string'
            ],
            [
                'key' => 'consultant_team_size',
                'value' => ['de' => '2-Personen-Team'],
                'type' => 'string'
            ],
            [
                'key' => 'consultant_rating',
                'value' => [
                    'de' => '5,0/5,0 Sterne aus 118 Kundenbewertungen',
                    'ar' => '5.0/5.0 نجوم من 118 تقييم عملاء'
                ],
                'type' => 'string'
            ],

            // Contact Information
            [
                'key' => 'contact_address_street',
                'value' => ['de' => 'Berliner Str. 22'],
                'type' => 'string'
            ],
            [
                'key' => 'contact_address_city',
                'value' => ['de' => '61137 Schöneck'],
                'type' => 'string'
            ],
            [
                'key' => 'contact_phone',
                'value' => ['de' => '+49 6187 9023048'],
                'type' => 'string'
            ],
            [
                'key' => 'contact_mobile',
                'value' => ['de' => '+49 171 7421462'],
                'type' => 'string'
            ],
            [
                'key' => 'contact_email',
                'value' => ['de' => 'Abdelaziz.Kallel@dvag.de'],
                'type' => 'string'
            ],

            // Company Information
            [
                'key' => 'company_name',
                'value' => ['de' => 'Deutsche Vermögensberatung'],
                'type' => 'string'
            ],

            // Hero Section
            [
                'key' => 'hero_title',
                'value' => [
                    'de' => 'Ihr persönlicher Finanzberater in Schöneck',
                    'ar' => 'مستشارك المالي الشخصي في شونيك'
                ],
                'type' => 'string'
            ],
            [
                'key' => 'hero_subtitle',
                'value' => [
                    'de' => 'Professionelle Finanzberatung mit Fokus auf Ihre Wünsche und Ziele',
                    'ar' => 'استشارات مالية احترافية تركز على أهدافك ورغباتك'
                ],
                'type' => 'string'
            ],
            [
                'key' => 'hero_description',
                'value' => ['de' => 'Als IHK-zertifizierter Finanzanlagenfachmann berate ich Sie seit 2009 umfassend in allen Finanzfragen. Ein Ansprechpartner für Ihre gesamte finanzielle Zukunft.'],
                'type' => 'text'
            ],

            // About Section
            [
                'key' => 'about_title',
                'value' => [
                    'de' => 'Über mich',
                    'ar' => 'من أنا'
                ],
                'type' => 'string'
            ],
            [
                'key' => 'about_content',
                'value' => ['de' => 'Seit 2009 bin ich als Vermögensberater für die Deutsche Vermögensberatung tätig und helfe meinen Kunden dabei, ihre finanzielle Situation zu organisieren und zu optimieren. Als IHK-zertifizierter Finanzanlagenfachmann arbeite ich mit einem erfahrenen 2-Personen-Team zusammen, um Ihnen die bestmögliche Beratung zu bieten.

Mein Fokus liegt auf kundenorientierten Lösungen, die individuell auf Ihre Bedürfnisse und Ziele zugeschnitten sind. Dabei stehe ich Ihnen als verlässlicher Ansprechpartner für alle Finanzfragen zur Verfügung - von der Anlageberatung über Versicherungsschutz bis hin zur Altersvorsorge.'],
                'type' => 'text'
            ],

            // Services
            [
                'key' => 'services_title',
                'value' => ['de' => 'Meine Leistungen'],
                'type' => 'string'
            ],
            [
                'key' => 'services_content',
                'value' => ['de' => json_encode([
                    'Umfassende Finanzberatung',
                    'Individuelle Anlagestrategien',
                    'Versicherungsberatung',
                    'Altersvorsorge-Planung',
                    'Beratung für Privat- und Firmenkunden',
                    '5-Schritte-Beratungsprozess'
                ])],
                'type' => 'json'
            ],

            // Process Section
            [
                'key' => 'process_title',
                'value' => ['de' => 'Mein 5-Schritte-Beratungsprozess'],
                'type' => 'string'
            ],
            [
                'key' => 'process_steps',
                'value' => ['de' => json_encode([
                    ['title' => 'Erstgespräch', 'description' => 'Analyse Ihrer aktuellen Situation und Ihrer Ziele'],
                    ['title' => 'Bestandsaufnahme', 'description' => 'Bewertung Ihrer bestehenden Finanzprodukte'],
                    ['title' => 'Strategieentwicklung', 'description' => 'Erstellung einer individuellen Finanzstrategie'],
                    ['title' => 'Umsetzung', 'description' => 'Implementierung der empfohlenen Lösungen'],
                    ['title' => 'Betreuung', 'description' => 'Kontinuierliche Begleitung und Anpassung']
                ])],
                'type' => 'json'
            ],

            // Contact Section
            [
                'key' => 'contact_title',
                'value' => [
                    'de' => 'Kontakt aufnehmen',
                    'ar' => 'اطلب استشارة'
                ],
                'type' => 'string'
            ],
            [
                'key' => 'contact_subtitle',
                'value' => [
                    'de' => 'Vereinbaren Sie noch heute einen unverbindlichen Beratungstermin',
                    'ar' => 'استشارة شخصية'
                ],
                'type' => 'string'
            ],

            // Why Me Section
            [
                'key' => 'why_me_title',
                'value' => [
                    'de' => 'Warum ich?',
                    'ar' => 'لماذا أنا؟'
                ],
                'type' => 'string'
            ],
            [
                'key' => 'why_me_benefits',
                'value' => [
                    'de' => json_encode([
                        'Kostenlose Erstberatung',
                        'Individuelle Lösungen für Ihre Ziele',
                        'Über Seit 2009 Jahre Erfahrung',
                        'Terminflexibilität nach Ihren Wünschen'
                    ]),
                    'ar' => json_encode([
                        'استشارة أولية مجانية',
                        'حلول مخصصة تناسب أهدافك',
                        'خبرة منذ 2009',
                        'مرونة في المواعيد حسب رغبتك'
                    ])
                ],
                'type' => 'json'
            ],

            // Service Categories
            [
                'key' => 'service_categories_title',
                'value' => [
                    'de' => 'Welche Themen interessieren Sie?',
                    'ar' => 'ما هي المواضيع التي تهمك؟'
                ],
                'type' => 'string'
            ],
            [
                'key' => 'service_categories',
                'value' => [
                    'de' => json_encode([
                        'Altersvorsorge',
                        'Versicherungen',
                        'Steueroptimierung',
                        'Geldanlage',
                        'Immobilienfinanzierung',
                        'Vermögensaufbau'
                    ]),
                    'ar' => json_encode([
                        'التقاعد',
                        'التأمينات',
                        'تحسين الضرائب',
                        'الاستثمارات',
                        'تمويل العقارات',
                        'بناء الثروة'
                    ])
                ],
                'type' => 'json'
            ],

            // Contact Labels
            [
                'key' => 'contact_direct_call_label',
                'value' => [
                    'de' => 'Direkter Anruf',
                    'ar' => 'اتصال مباشر'
                ],
                'type' => 'string'
            ],
            [
                'key' => 'contact_consultation_label',
                'value' => [
                    'de' => 'Persönliche Beratung',
                    'ar' => 'استشارة شخصية'
                ],
                'type' => 'string'
            ],

            // About Me Section - Expertise and Trust
            [
                'key' => 'about_expertise',
                'value' => [
                    'de' => 'Über Seit 2009 Jahre Erfahrung in der Finanzberatung',
                    'ar' => 'خبرة في الاستشارات المالية منذ عام 2009'
                ],
                'type' => 'string'
            ],
            [
                'key' => 'about_trust',
                'value' => [
                    'de' => 'Zertifizierter Finanzberater',
                    'ar' => 'مستشار مالي معتمد'
                ],
                'type' => 'string'
            ],

            // Landing Page Settings
            [
                'key' => 'landing_headline',
                'value' => [
                    'de' => 'Kostenlose Finanzberatung vereinbaren',
                    'ar' => 'احجز استشارة مالية مجانية'
                ],
                'type' => 'string'
            ],
            [
                'key' => 'landing_lede',
                'value' => [
                    'de' => 'Professionelle Beratung für Ihre finanzielle Zukunft. Vereinbaren Sie jetzt ein unverbindliches Gespräch mit Ihrem persönlichen Finanzberater.',
                    'ar' => 'استشارة مهنية لمستقبلك المالي. احجز الآن محادثة غير ملزمة مع مستشارك المالي الشخصي.'
                ],
                'type' => 'text'
            ],
            [
                'key' => 'landing_meta_title',
                'value' => [
                    'de' => 'Kostenlose Finanzberatung | Abdelaziz Kallel - Deutsche Vermögensberatung',
                    'ar' => 'استشارة مالية مجانية | عبد العزيز قلال - الاستشارات المالية الألمانية'
                ],
                'type' => 'string'
            ],
            [
                'key' => 'landing_meta_description',
                'value' => [
                    'de' => 'Vereinbaren Sie eine kostenlose Finanzberatung mit IHK-zertifiziertem Finanzberater Abdelaziz Kallel. Unverbindlicher Termin in Schöneck oder online. ☎ +49 6187 9023048',
                    'ar' => 'احجز استشارة مالية مجانية مع المستشار المالي المعتمد عبد العزيز قلال. موعد غير ملزم في شونيك أو عبر الإنترنت.'
                ],
                'type' => 'string'
            ],

            // SEO/Meta Information
            [
                'key' => 'meta_title',
                'value' => ['de' => 'Abdelaziz Kallel - Vermögensberater in Schöneck | Deutsche Vermögensberatung'],
                'type' => 'string'
            ],
            [
                'key' => 'meta_description',
                'value' => ['de' => 'IHK-zertifizierter Finanzanlagenfachmann Abdelaziz Kallel berät Sie seit 2009 in Schöneck. Individuelle Finanzberatung, Anlagestrategien und Altersvorsorge. ☎ +49 6187 9023048'],
                'type' => 'string'
            ]
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                [
                    'value' => $setting['value'],
                    'type' => $setting['type']
                ]
            );
        }
    }
}
