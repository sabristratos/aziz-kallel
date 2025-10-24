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
                'value' => [
                    'de' => '+49 6187 9023048',
                    'ar' => '+49 6187 9023048',
                ],
                'type' => 'string',
            ],
            [
                'key' => 'contact_mobile',
                'value' => [
                    'de' => '+49 171 7421462',
                    'ar' => '+49 171 7421462',
                ],
                'type' => 'string',
            ],
            [
                'key' => 'contact_email',
                'value' => [
                    'de' => 'Abdelaziz.Kallel@dvag.de',
                    'ar' => 'Abdelaziz.Kallel@dvag.de',
                ],
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
                'value' => 'smtp',
                'type' => 'string',
            ],
            [
                'key' => 'mail_host',
                'value' => 'smtp.gmail.com',
                'type' => 'string',
            ],
            [
                'key' => 'mail_port',
                'value' => '587',
                'type' => 'string',
            ],
            [
                'key' => 'mail_username',
                'value' => 'Rosa Media Team',
                'type' => 'string',
            ],
            [
                'key' => 'mail_password',
                'value' => 'gqheusdeykxanyqr',
                'type' => 'string',
            ],
            [
                'key' => 'mail_encryption',
                'value' => 'tls',
                'type' => 'string',
            ],
            [
                'key' => 'mail_from_address',
                'value' => 'abdelkader.gueddana@rosa-media.com',
                'type' => 'string',
            ],
            [
                'key' => 'mail_from_name',
                'value' => 'Rosa Media Team',
                'type' => 'string',
            ],

            // Email Customization
            [
                'key' => 'email_consultation_subject',
                'value' => [
                    'de' => 'Vielen Dank für Ihre Anfrage',
                    'ar' => 'شكراً لاستفسارك',
                ],
                'type' => 'string',
            ],
            [
                'key' => 'email_consultation_body',
                'value' => [
                    'de' => "Guten Tag {name},\n\nvielen Dank für Ihr Interesse an einer persönlichen Finanzberatung. Ihre Anfrage ist bei uns eingegangen.\n\n**Ihre ausgewählten Themen:**\n{topics}\n\nIch werde mich innerhalb der nächsten 24-48 Stunden bei Ihnen melden, um einen passenden Termin für ein unverbindliches Beratungsgespräch zu vereinbaren.\n\nIn diesem Gespräch können wir Ihre finanzielle Situation und Ihre Ziele ausführlich besprechen und gemeinsam die beste Lösung für Sie entwickeln.\n\n{notes}\n\nSollten Sie vorab Fragen haben, können Sie mich gerne kontaktieren:\n\nE-Mail: {email}\n{phone}\n\nIch freue mich auf unser Gespräch!",
                    'ar' => "مرحباً {name},\n\nشكراً لاهتمامك بالاستشارة المالية الشخصية. لقد استلمنا استفسارك.\n\n**المواضيع المحددة:**\n{topics}\n\nسأتواصل معك خلال 24-48 ساعة القادمة لترتيب موعد مناسب لاستشارة غير ملزمة.\n\nفي هذا الاجتماع، يمكننا مناقشة وضعك المالي وأهدافك بالتفصيل وتطوير أفضل حل لك معاً.\n\n{notes}\n\nإذا كان لديك أي أسئلة مسبقة، يمكنك التواصل معي:\n\nالبريد الإلكتروني: {email}\n{phone}\n\nأتطلع للقائك!",
                ],
                'type' => 'text',
            ],
            [
                'key' => 'email_consultation_footer',
                'value' => [
                    'de' => 'Mit freundlichen Grüßen,',
                    'ar' => 'مع أطيب التحيات،',
                ],
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

            // Legal Content
            [
                'key' => 'impressum_content',
                'value' => [
                    'de' => '<p>Abdelaziz Kallel<br>Berliner Str. 22<br>61137 Schöneck<br>Telefon: +49 6187 9023048<br>Fax: +49 6187 2029993<br>E-Mail: abdelaziz.kallel@dvag.de<br>Internet: www.dvag.de/Abdelaziz.Kallel</p><p>Im Versicherungsbereich als gebundener Vermittler gemäß § 34d Abs. 7 GewO auf Provisionsbasis ausschließlich vermittelnd und beratend tätig für die Generali Deutschland Lebensversicherung, Generali Deutschland Versicherung, Generali Deutschland Krankenversicherung, Generali Pensionskasse, ADVOCARD Rechtsschutzversicherung. Darüber hinaus können in Einzelfällen geldwerte Vorteile in Form von Sachleistungen anfallen (z.B. Schulungen sowie Einladungen für die Teilnahme an kulturellen und gesellschaftlichen Veranstaltungen, Informationsmaterial, Aufmerksamkeiten)</p><h2>Schlichtungsstellen:</h2><p>Verein Versicherungsombudsmann e.V.<br>Postfach 080632, 10006 Berlin<br><br>Ombudsmann Private Kranken- und Pflegeversicherung<br>Postfach 060222, 10052 Berlin<br><br>www.versicherungsombudsmann.de, www.pkv-ombudsmann.de</p><p>Erlaubnis- und Aufsichtsbehörde gemäß § 34c GewO: Landkreis Fulda, Postfach 1654, 36006 Fulda</p><p>Im Investmentbereich als Finanzanlagenvermittler gemäß § 34f Abs. 1 Nr. 1 GewO nicht unabhängig vermittelnd tätig für: DWS Investment GmbH, DWS Investment S.A., Generali Investments Deutschland, Allianz Global Investors, Allianz Global Investors Luxembourg, SEB Investment, DWS Grundbesitz GmbH.</p><p>Die Anlageberatung und Anlagevermittlung zu Investmentfonds erfolgen in deutscher und - soweit mit dem Vermögensberater individuell vereinbart - in englischer Sprache. Detaillierte Informationen zu diesen Produkten können den Fondsunterlagen (z.B. Prospekt und wesentliche Anlegerinformationen) entnommen werden, die kostenlos in deutscher Sprache vom Vermögensberater oder auf der Webseite www.dvag-produktinformationen.de bereitgestellt werden. Die Kommunikation zwischen Vermögensberater und Kunde erfolgt ausschließlich persönlich, postalisch, per E-Mail, Telefon, Video und/oder Fax.</p><p>Nach erbrachter Anlageberatung zu Investmentfonds erhalten die Kunden vom Vermögensberater eine Erklärung zur Geeignetheit der empfohlenen Produkte und sonstigen Empfehlungen.</p><p>Erlaubnis- und Aufsichtsbehörde gemäß § 34f GewO: IHK Wiesbaden, Wilhelmstr. 24-26, 65183 Wiesbaden</p><p>Im Immobiliarverbraucherdarlehensbereich als Immobiliardarlehensvermittler gemäß § 34i Abs. 1 GewO vermittelnd tätig für: Deutsche Bank AG, Deutsche Bausparkasse Badenia AG, Commerzbank AG, HypoVereinsbank, Santander Consumer Bank AG</p><p>Erlaubnis- und Aufsichtsbehörde gemäß § 34i GewO: Der Kreisausschuss, Im Niederfeld, 63589 Linsengericht</p><h2>Gemeinsame Registerstelle</h2><p>Deutsche Industrie- und Handelskammer (DIHK)<br>Breite Straße 29, 10178 Berlin<br>Telefon: 0180 600585-0 (20 Cent/Anruf)<br>www.vermittlerregister.info</p><p>Registernummer nach § 34d GewO: D-EI6L-O9B02-64<br>Registernummer nach § 34f GewO: D-F-132-4HK1-31<br>Registernummer nach § 34i GewO: D-W-132-WXGS-92</p><p>Die Vermögensberater nehmen keine Kundengelder entgegen. Zahlungen erfolgen direkt von den Kunden an die jeweiligen Produktpartner.</p><h2>Haftungshinweis:</h2><p>Trotz sorgfältiger inhaltlicher Kontrolle übernehmen wir keine Haftung für die Inhalte externer Links. Für den Inhalt der verlinkten Seiten sind ausschließlich deren Betreiber verantwortlich.</p>',
                    'ar' => '<p dir="rtl">عبد العزيز قلال<br>Berliner Str. 22<br>61137 Schöneck<br>هاتف: +49 6187 9023048<br>فاكس: +49 6187 2029993<br>البريد الإلكتروني: abdelaziz.kallel@dvag.de<br>الإنترنت: www.dvag.de/Abdelaziz.Kallel</p>',
                ],
                'type' => 'text',
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
