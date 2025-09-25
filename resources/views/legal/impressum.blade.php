@extends('components.layouts.legal')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-12 lg:py-16">
    <div class="animate-fade-in">
        <x-ui.heading level="1" class="mb-8 ltr:text-left rtl:text-right">{{ __('Impressum') }}</x-ui.heading>

        <div class="prose prose-slate prose-lg max-w-none ltr:prose rtl:prose-rtl">
        <h2>{{ __('Angaben gem. § 5 TMG') }}</h2>
        <p>
            Abdelaziz Kallel<br>
            {{ __('Vermögensberater') }}<br>
            {{ __('Deutsche Vermögensberatung AG') }}
        </p>

        <h2>{{ __('Kontakt') }}</h2>
        <p>
            {{ __('E-Mail') }}: info@abdelaziz-kallel.de<br>
            {{ __('Internet') }}: www.abdelaziz-kallel.de
        </p>

        <h2>{{ __('Berufsbezeichnung und berufsrechtliche Regelungen') }}</h2>
        <p>
            <strong>{{ __('Berufsbezeichnung:') }}</strong> {{ __('Vermögensberater') }}<br>
            <strong>{{ __('Zuständige Kammer:') }}</strong> {{ __('Deutsche Vermögensberatung') }} AG<br>
            <strong>{{ __('Verliehen durch:') }}</strong> {{ __('Deutschland') }}
        </p>

        <h2>{{ __('Aufsichtsbehörde') }}</h2>
        <p>
            {{ __('Deutsche Vermögensberatung AG') }}<br>
            {{ __('Platz der Deutschen Vermögensberatung 1') }}<br>
            {{ __('60327 Frankfurt am Main') }}
        </p>

        <h2>{{ __('Redaktionell verantwortlich') }}</h2>
        <p>
            Abdelaziz Kallel<br>
            {{ __('Deutsche Vermögensberatung') }}
        </p>

        <h2>{{ __('EU-Streitschlichtung') }}</h2>
        <p>{{ __('Die Europäische Kommission stellt eine Plattform zur Online-Streitbeilegung (OS) bereit:') }}
        <a href="https://ec.europa.eu/consumers/odr/" target="_blank" rel="noopener noreferrer" class="text-science-blue-600 hover:text-science-blue-700">
            https://ec.europa.eu/consumers/odr/
        </a><br>
        {{ __('Unsere E-Mail-Adresse finden Sie oben im Impressum.') }}</p>

        <h2>{{ __('Verbraucherstreitbeilegung/Universalschlichtungsstelle') }}</h2>
        <p>{{ __('Wir sind nicht bereit oder verpflichtet, an Streitbeilegungsverfahren vor einer Verbraucherschlichtungsstelle teilzunehmen.') }}</p>

        <h2>{{ __('Zentrale Kontaktstelle nach dem Digital Services Act - DSA (Verordnung (EU) 2022/2065)') }}</h2>
        <p>{{ __('Unsere zentrale Kontaktstelle für Nutzer und Behörden nach Art. 11, 12 DSA erreichen Sie wie folgt:') }}</p>
        <p>{{ __('E-Mail') }}: info@abdelaziz-kallel.de</p>
        <p>{{ __('Die für den Kontakt verfügbaren Sprachen sind: Deutsch, Englisch.') }}</p>

        <h2>{{ __('Haftung für Inhalte') }}</h2>
        <p>{{ __('Als Diensteanbieter sind wir gemäß § 7 Abs.1 TMG für eigene Inhalte auf diesen Seiten nach den allgemeinen Gesetzen verantwortlich. Nach §§ 8 bis 10 TMG sind wir als Diensteanbieter jedoch nicht unter der Verpflichtung, übermittelte oder gespeicherte fremde Informationen zu überwachen oder nach Umständen zu forschen, die auf eine rechtswidrige Tätigkeit hinweisen.') }}</p>

        <p>{{ __('Verpflichtungen zur Entfernung oder Sperrung der Nutzung von Informationen nach den allgemeinen Gesetzen bleiben hiervon unberührt. Eine diesbezügliche Haftung ist jedoch erst ab dem Zeitpunkt der Kenntnis einer konkreten Rechtsverletzung möglich. Bei Bekanntwerden von entsprechenden Rechtsverletzungen werden wir diese Inhalte umgehend entfernen.') }}</p>

        <h2>{{ __('Haftung für Links') }}</h2>
        <p>{{ __('Unser Angebot enthält Links zu externen Websites Dritter, auf deren Inhalte wir keinen Einfluss haben. Deshalb können wir für diese fremden Inhalte auch keine Gewähr übernehmen. Für die Inhalte der verlinkten Seiten ist stets der jeweilige Anbieter oder Betreiber der Seiten verantwortlich. Die verlinkten Seiten wurden zum Zeitpunkt der Verlinkung auf mögliche Rechtsverstöße überprüft. Rechtswidrige Inhalte waren zum Zeitpunkt der Verlinkung nicht erkennbar.') }}</p>

        <p>{{ __('Eine permanente inhaltliche Kontrolle der verlinkten Seiten ist jedoch ohne konkrete Anhaltspunkte einer Rechtsverletzung nicht zumutbar. Bei Bekanntwerden von Rechtsverletzungen werden wir derartige Links umgehend entfernen.') }}</p>

        <h2>{{ __('Urheberrecht') }}</h2>
        <p>{{ __('Die durch die Seitenbetreiber erstellten Inhalte und Werke auf diesen Seiten unterliegen dem deutschen Urheberrecht. Die Vervielfältigung, Bearbeitung, Verbreitung und jede Art der Verwertung außerhalb der Grenzen des Urheberrechtes bedürfen der schriftlichen Zustimmung des jeweiligen Autors bzw. Erstellers. Downloads und Kopien dieser Seite sind nur für den privaten, nicht kommerziellen Gebrauch gestattet.') }}</p>

        <p>{{ __('Soweit die Inhalte auf dieser Seite nicht vom Betreiber erstellt wurden, werden die Urheberrechte Dritter beachtet. Insbesondere werden Inhalte Dritter als solche gekennzeichnet. Sollten Sie trotzdem auf eine Urheberrechtsverletzung aufmerksam werden, bitten wir um einen entsprechenden Hinweis. Bei Bekanntwerden von Rechtsverletzungen werden wir derartige Inhalte umgehend entfernen.') }}</p>

        </div>
    </div>
</div>
@endsection