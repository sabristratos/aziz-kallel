<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestimonialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'client_name' => 'ATA. Azza Ben Noemen',
                'content' => ['de' => 'Herr Kallel war immer für uns da, hat uns zugehört und uns mit viel Herz und Respekt den richtigen Weg gezeigt. Bei ihm fühlt man sich verstanden und gut aufgehoben.'],
                'rating' => 5,
                'order' => 1,
                'is_active' => true
            ],
            [
                'client_name' => 'Ing. Abdelkader Gueddana',
                'content' => ['de' => 'Abdelaziz Kallel war immer an meiner Seite bei den wichtigsten Momenten in meinem Leben... Er hat mir jedes Mal geholfen, die richtigen Entscheidungen zu treffen.'],
                'rating' => 5,
                'order' => 2,
                'is_active' => true
            ],
            [
                'client_name' => 'Dr. Sallem',
                'content' => ['de' => 'Herr kallel ist ein professioneller Vermögensberater. Er nimmt sich ausreichend Zeit, hört aufmerksam zu und geht individuell auf meine Fragen und Bedürfnisse ein.'],
                'rating' => 5,
                'order' => 3,
                'is_active' => true
            ],
            [
                'client_name' => 'Ing. Ons Lamine',
                'content' => ['de' => 'Sehr professionelle Beratung mit klarem Fokus auf individuelle Lösungen. Fachlich stark, transparent und zuverlässig.'],
                'rating' => 5,
                'order' => 4,
                'is_active' => true
            ],
            [
                'client_name' => 'Ing. Yassine',
                'content' => ['de' => 'Abdelaziz hat mich umfassend zu verschiedenen Themen beraten. Dank seiner Kompetenz und Erfahrung konnte ich meine Finanzen innerhalb kurzer Zeit auf ein neues Niveau bringen.'],
                'rating' => 5,
                'order' => 5,
                'is_active' => true
            ]
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
