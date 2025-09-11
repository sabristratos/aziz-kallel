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
                'question' => ['de' => 'Wie läuft eine Finanzberatung bei Ihnen ab?'],
                'answer' => ['de' => 'Meine Finanzberatung erfolgt in einem strukturierten 5-Schritte-Prozess: Zunächst führen wir ein ausführliches Erstgespräch, in dem ich Ihre aktuelle Situation und Ihre Ziele analysiere. Anschließend bewerte ich Ihre bestehenden Finanzprodukte und entwickle eine individuelle Strategie für Sie. Nach der gemeinsamen Umsetzung der empfohlenen Lösungen begleite ich Sie kontinuierlich und passe die Strategie bei Bedarf an.'],
                'order' => 1,
                'is_active' => true
            ],
            [
                'question' => ['de' => 'Welche Kosten entstehen für die Beratung?'],
                'answer' => ['de' => 'Das Erstgespräch und die grundlegende Analyse Ihrer Finanzsituation sind für Sie kostenfrei. Als Vermögensberater der Deutschen Vermögensberatung erhalte ich meine Vergütung über die Produktpartner, sodass für Sie keine direkten Beratungskosten anfallen. Transparenz ist mir dabei sehr wichtig - Sie erfahren immer im Voraus, wie sich die Kosten zusammensetzen.'],
                'order' => 2,
                'is_active' => true
            ],
            [
                'question' => ['de' => 'Welche Anlageformen empfehlen Sie?'],
                'answer' => ['de' => 'Die Empfehlung der passenden Anlageform hängt von Ihrer individuellen Situation, Ihren Zielen und Ihrer Risikobereitschaft ab. Das Spektrum reicht von konservativen Sparformen über Investmentfonds und ETFs bis hin zu strukturierten Produkten. Wichtig ist mir dabei immer eine ausgewogene Diversifikation und dass Sie die gewählten Anlageformen verstehen und sich damit wohlfühlen.'],
                'order' => 3,
                'is_active' => true
            ],
            [
                'question' => ['de' => 'Wie plane ich meine Altersvorsorge optimal?'],
                'answer' => ['de' => 'Eine optimale Altersvorsorge baut auf drei Säulen auf: der gesetzlichen Rente, der betrieblichen Altersvorsorge und der privaten Vorsorge. Je früher Sie beginnen, desto besser können Sie den Zinseszinseffekt nutzen. Ich analysiere Ihre aktuelle Versorgungssituation, berechnen die zu erwartende Rentenlücke und entwickeln gemeinsam mit Ihnen eine passende Strategie zur Schließung dieser Lücke.'],
                'order' => 4,
                'is_active' => true
            ],
            [
                'question' => ['de' => 'Welche Versicherungen sind wirklich notwendig?'],
                'answer' => ['de' => 'Die Auswahl der richtigen Versicherungen hängt von Ihrer Lebenssituation ab. Zu den wichtigsten Versicherungen gehören meist die Privathaftpflicht, Berufsunfähigkeitsversicherung und für Familien eine Risikolebensversicherung. Bei der Krankenversicherung und anderen Sparten prüfe ich gemeinsam mit Ihnen, welcher Schutz sinnvoll und bezahlbar ist, ohne Sie zu überversichern.'],
                'order' => 5,
                'is_active' => true
            ],
            [
                'question' => ['de' => 'Beraten Sie auch Firmenkunden?'],
                'answer' => ['de' => 'Ja, ich berate auch Unternehmer und Firmenkunden. Dazu gehören Themen wie betriebliche Altersvorsorge, Firmenversicherungen, Liquiditätsplanung und die private Absicherung von Geschäftsführern und Selbstständigen. Als Unternehmer haben Sie oft spezielle Anforderungen, die eine maßgeschneiderte Beratung erfordern.'],
                'order' => 6,
                'is_active' => true
            ],
            [
                'question' => ['de' => 'Wie oft sollten wir uns abstimmen?'],
                'answer' => ['de' => 'Nach der ersten Umsetzung empfehle ich mindestens einen jährlichen Termin zur Überprüfung Ihrer Finanzstrategie. Bei größeren Lebensveränderungen wie Heirat, Nachwuchs oder Jobwechsel sollten wir uns zeitnah abstimmen. Darüber hinaus bin ich jederzeit für Ihre Fragen erreichbar - eine gute Betreuung bedeutet für mich, dass Sie sich jederzeit gut aufgehoben fühlen.'],
                'order' => 7,
                'is_active' => true
            ],
            [
                'question' => ['de' => 'Was unterscheidet Sie von anderen Finanzberatern?'],
                'answer' => ['de' => 'Als IHK-zertifizierter Finanzanlagenfachmann mit über 15 Jahren Erfahrung kenne ich den Markt und die Produkte sehr gut. Besonders wichtig ist mir die persönliche, langfristige Betreuung meiner Kunden. Ich arbeite mit einem kleinen, erfahrenen Team zusammen, sodass Sie immer einen direkten Ansprechpartner haben. Mein Fokus liegt auf individuellen, kundenorientierten Lösungen statt Standardprodukten.'],
                'order' => 8,
                'is_active' => true
            ]
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
