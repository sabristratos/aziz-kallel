<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question' => [
                    'de' => 'Wie läuft eine Finanzberatung bei Ihnen ab?',
                    'ar' => 'كيف تتم الاستشارة المالية معك؟'
                ],
                'answer' => [
                    'de' => 'Die Finanzberatung bei mir läuft nach einem strukturierten Prozess in fünf Schritten ab: Zunächst führen wir ein umfassendes Erstgespräch, in dem ich Ihre aktuelle Situation und Ziele analysiere. Anschließend bewerte ich Ihre bestehenden Finanzprodukte und entwickle eine individuelle Strategie. Nach gemeinsamer Umsetzung der empfohlenen Lösungen begleite ich Sie kontinuierlich und passe die Strategie an. Dabei ist mir wichtig: ausgewogene Diversifikation und dass Sie Ihre Anlagemöglichkeiten verstehen und sich damit wohlfühlen.',
                    'ar' => 'تقدم الاستشارة الأولى دون أي تكلفة أو التزام. في هذا اللقاء، نحلل وضعك المالي الحالي، ونناقش أهدافك، ونوضح كيف يمكنني مساعدتك. فقط إذا قررت أن تعمل معي، سنتابع التخطيط المفصل.'
                ],
                'order' => 1,
                'is_active' => true
            ],
            [
                'question' => [
                    'de' => 'Welche Kosten entstehen für die Beratung?',
                    'ar' => 'ما هي التكاليف المترتبة على الاستشارة؟'
                ],
                'answer' => [
                    'de' => 'Das Erstgespräch und die grundlegende Analyse Ihrer Finanzsituation sind für Sie kostenfrei. Als Vermögensberater der Deutschen Vermögensberatung erhalte ich meine Vergütung über die Produktpartner, sodass für Sie keine direkten Beratungskosten anfallen. Transparenz ist mir dabei sehr wichtig - Sie erfahren immer im Voraus, wie sich die Kosten zusammensetzen.',
                    'ar' => 'كوني مستشار معتمد لدى شركة الاستشارات المالية الألمانية (DVAG)، أعمل حصريًا لصالح عملائي. أحصل على أجري من مقدمي المنتجات، وليس منك مباشرة، مما يعني أن خدماتي مجانية تمامًا لك. هذا النموذج يسمح لي بتقديم استشارة مستقلة دون تضارب في المصالح.'
                ],
                'order' => 2,
                'is_active' => true
            ],
            [
                'question' => [
                    'de' => 'Welche Anlageformen empfehlen Sie?',
                    'ar' => 'ما هي أشكال الاستثمار التي توصي بها؟'
                ],
                'answer' => [
                    'de' => 'Die Empfehlung der passenden Anlageform hängt von Ihrer individuellen Situation, Ihren Zielen und Ihrer Risikobereitschaft ab. Das Spektrum reicht von konservativen Sparformen über Investmentfonds und ETFs bis hin zu strukturierten Produkten. Wichtig ist mir dabei immer eine ausgewogene Diversifikation und dass Sie die gewählten Anlageformen verstehen und sich damit wohlfühlen.',
                    'ar' => 'نعم، أقدم الاستشارة في أي مكان يناسبك - سواء في منزلك، مكتبك، أو في مكتبي في شونيك. كما أقدم أيضًا استشارات عبر الفيديو عبر الإنترنت. المرونة في المواعيد والمكان مهمة جدًا بالنسبة لي لتناسب جدولك الزمني.'
                ],
                'order' => 3,
                'is_active' => true
            ],
            [
                'question' => [
                    'de' => 'Wie plane ich meine Altersvorsorge optimal?',
                    'ar' => 'كيف أخطط لتقاعدي بشكل مثالي؟'
                ],
                'answer' => [
                    'de' => 'Eine optimale Altersvorsorge baut auf drei Säulen auf: der gesetzlichen Rente, der betrieblichen Altersvorsorge und der privaten Vorsorge. Je früher Sie beginnen, desto besser können Sie den Zinseszinseffekt nutzen. Ich analysiere Ihre aktuelle Versorgungssituation, berechnen die zu erwartende Rentenlücke und entwickeln gemeinsam mit Ihnen eine passende Strategie zur Schließung dieser Lücke.',
                    'ar' => 'أقدم خدمات شاملة في مجال الاستشارات المالية: التخطيط للتقاعد، الاستثمارات، التأمينات، تمويل العقارات، تحسين الضرائب، وبناء الثروة. كل استشارة مصممة خصيصًا حسب وضعك الشخصي وأهدافك المالية.'
                ],
                'order' => 4,
                'is_active' => true
            ],
            [
                'question' => [
                    'de' => 'Welche Versicherungen sind wirklich notwendig?',
                    'ar' => 'ما هي التأمينات الضرورية حقًا؟'
                ],
                'answer' => [
                    'de' => 'Die Auswahl der richtigen Versicherungen hängt von Ihrer Lebenssituation ab. Zu den wichtigsten Versicherungen gehören meist die Privathaftpflicht, Berufsunfähigkeitsversicherung und für Familien eine Risikolebensversicherung. Bei der Krankenversicherung und anderen Sparten prüfe ich gemeinsam mit Ihnen, welcher Schutz sinnvoll und bezahlbar ist, ohne Sie zu überversichern.',
                    'ar' => 'اختيار التأمينات المناسبة يعتمد على وضعك الشخصي. من أهم التأمينات عادةً التأمين ضد المسؤولية الشخصية، التأمين ضد العجز عن العمل، وللعائلات تأمين الحياة. أما بالنسبة للتأمين الصحي والتأمينات الأخرى، فأقوم بمراجعتها معك لتحديد أيها مناسب وضروري وبسعر معقول، حتى لا يكون لديك تغطية زائدة عن الحاجة.'
                ],
                'order' => 5,
                'is_active' => true
            ],
            [
                'question' => [
                    'de' => 'Beraten Sie auch Firmenkunden?',
                    'ar' => 'هل تقدم الاستشارة للشركات أيضًا؟'
                ],
                'answer' => [
                    'de' => 'Ja, ich berate auch Unternehmer und Firmenkunden. Dazu gehören Themen wie betriebliche Altersvorsorge, Firmenversicherungen, Liquiditätsplanung und die private Absicherung von Geschäftsführern und Selbstständigen. Als Unternehmer haben Sie oft spezielle Anforderungen, die eine maßgeschneiderte Beratung erfordern.',
                    'ar' => 'نعم، أقدم الاستشارة أيضًا للشركات ورجال الأعمال. يشمل ذلك مواضيع مثل تقاعد الشركات، تأمينات الشركات، تخطيط السيولة والحماية الشخصية للمديرين وأصحاب الأعمال الحرة. بصفتك رجل أعمال فإن لديك عادةً متطلبات خاصة تتطلب استشارة مخصصة.'
                ],
                'order' => 6,
                'is_active' => true
            ],
            [
                'question' => [
                    'de' => 'Wie oft sollten wir uns abstimmen?',
                    'ar' => 'كم مرة يجب أن نتواصل؟'
                ],
                'answer' => [
                    'de' => 'Nach der ersten Umsetzung empfehle ich mindestens einen jährlichen Termin zur Überprüfung Ihrer Finanzstrategie. Bei größeren Lebensveränderungen wie Heirat, Nachwuchs oder Jobwechsel sollten wir uns zeitnah abstimmen. Darüber hinaus bin ich jederzeit für Ihre Fragen erreichbar - eine gute Betreuung bedeutet für mich, dass Sie sich jederzeit gut aufgehoben fühlen.',
                    'ar' => 'بعد التنفيذ الأولي أوصي بعقد لقاء واحد على الأقل سنويًا لمراجعة استراتيجيتك المالية. عند حدوث تغييرات كبيرة في حياتك يجب أن نتواصل في الوقت المناسب. بالإضافة إلى ذلك فإنني متاح دائمًا للإجابة على أسئلتك - ما يهمني هو أن تشعر بالراحة والأمان دائمًا.'
                ],
                'order' => 7,
                'is_active' => true
            ],
            [
                'question' => [
                    'de' => 'Was unterscheidet Sie von anderen Finanzberatern?',
                    'ar' => 'ما الذي يميزك عن المستشارين الماليين الآخرين؟'
                ],
                'answer' => [
                    'de' => 'Als IHK-zertifizierter Finanzanlagenfachmann mit über 15 Jahren Erfahrung kenne ich den Markt und die Produkte sehr gut. Besonders wichtig ist mir die persönliche, langfristige Betreuung meiner Kunden. Ich arbeite mit einem kleinen, erfahrenen Team zusammen, sodass Sie immer einen direkten Ansprechpartner haben. Mein Fokus liegt auf individuellen, kundenorientierten Lösungen statt Standardprodukten.',
                    'ar' => 'بصفتي متخصص في الاستثمارات المالية معتمد من غرفة الصناعة والتجارة مع أكثر من 15 عامًا من الخبرة، فإنني أعرف السوق والمنتجات جيدًا. ما يهمني بشكل خاص هو الرعاية الشخصية طويلة المدى لعملائي. أعمل مع فريق صغير ذو خبرة، بحيث يكون لديك دائمًا شخص مرجعي مباشر. تركيزي ينصب على الحلول الفردية الموجهة للعميل بدلًا من المنتجات القياسية.'
                ],
                'order' => 8,
                'is_active' => true
            ]
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
