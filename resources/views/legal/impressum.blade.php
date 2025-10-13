@extends('components.layouts.legal')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-12 lg:py-16">
    <div class="animate-fade-in">
        <x-ui.heading level="1" class="mb-8 ltr:text-left rtl:text-right">{{ __('Impressum') }}</x-ui.heading>

        <div class="prose prose-slate prose-lg max-w-none ltr:prose rtl:prose-rtl">
            <p>
                Abdelaziz Kallel<br>
                Berliner Str. 22<br>
                61137 Schöneck<br>
                {{ __('Telefon') }}: +49 6187 9023048<br>
                Fax: +49 6187 2029993<br>
                {{ __('E-Mail') }}: abdelaziz.kallel@dvag.de<br>
                {{ __('Internet') }}: www.dvag.de/Abdelaziz.Kallel
            </p>

            <p>{{ __('Im Versicherungsbereich als gebundener Vermittler gemäß § 34d Abs. 7 GewO auf Provisionsbasis ausschließlich vermittelnd und beratend tätig für die Generali Deutschland Lebensversicherung, Generali Deutschland Versicherung, Generali Deutschland Krankenversicherung, Generali Pensionskasse, ADVOCARD Rechtsschutzversicherung. Darüber hinaus können in Einzelfällen geldwerte Vorteile in Form von Sachleistungen anfallen (z.B. Schulungen sowie Einladungen für die Teilnahme an kulturellen und gesellschaftlichen Veranstaltungen, Informationsmaterial, Aufmerksamkeiten)') }}</p>

            <h2>{{ __('Schlichtungsstellen:') }}</h2>
            <p>
                Verein Versicherungsombudsmann e.V.<br>
                Postfach 080632, 10006 Berlin<br>
                <br>
                Ombudsmann Private Kranken- und Pflegeversicherung<br>
                Postfach 060222, 10052 Berlin<br>
                <br>
                www.versicherungsombudsmann.de, www.pkv-ombudsmann.de
            </p>

            <p>{{ __('Erlaubnis- und Aufsichtsbehörde gemäß § 34c GewO:') }} Landkreis Fulda, Postfach 1654, 36006 Fulda</p>

            <p>{{ __('Im Investmentbereich als Finanzanlagenvermittler gemäß § 34f Abs. 1 Nr. 1 GewO nicht unabhängig vermittelnd tätig für: DWS Investment GmbH, DWS Investment S.A., Generali Investments Deutschland, Allianz Global Investors, Allianz Global Investors Luxembourg, SEB Investment, DWS Grundbesitz GmbH.') }}</p>

            <p>{{ __('Die Anlageberatung und Anlagevermittlung zu Investmentfonds erfolgen in deutscher und - soweit mit dem Vermögensberater individuell vereinbart - in englischer Sprache. Detaillierte Informationen zu diesen Produkten können den Fondsunterlagen (z.B. Prospekt und wesentliche Anlegerinformationen) entnommen werden, die kostenlos in deutscher Sprache vom Vermögensberater oder auf der Webseite www.dvag-produktinformationen.de bereitgestellt werden. Die Kommunikation zwischen Vermögensberater und Kunde erfolgt ausschließlich persönlich, postalisch, per E-Mail, Telefon, Video und/oder Fax.') }}</p>

            <p>{{ __('Nach erbrachter Anlageberatung zu Investmentfonds erhalten die Kunden vom Vermögensberater eine Erklärung zur Geeignetheit der empfohlenen Produkte und sonstigen Empfehlungen.') }}</p>

            <p>{{ __('Erlaubnis- und Aufsichtsbehörde gemäß § 34f GewO:') }} IHK Wiesbaden, Wilhelmstr. 24-26, 65183 Wiesbaden</p>

            <p>{{ __('Im Immobiliarverbraucherdarlehensbereich als Immobiliardarlehensvermittler gemäß § 34i Abs. 1 GewO vermittelnd tätig für: Deutsche Bank AG, Deutsche Bausparkasse Badenia AG, Commerzbank AG, HypoVereinsbank, Santander Consumer Bank AG') }}</p>

            <p>{{ __('Erlaubnis- und Aufsichtsbehörde gemäß § 34i GewO:') }} Der Kreisausschuss, Im Niederfeld, 63589 Linsengericht</p>

            <h2>{{ __('Gemeinsame Registerstelle') }}</h2>
            <p>
                Deutsche Industrie- und Handelskammer (DIHK)<br>
                Breite Straße 29, 10178 Berlin<br>
                {{ __('Telefon') }}: 0180 600585-0 (20 Cent/Anruf)<br>
                www.vermittlerregister.info
            </p>

            <p>
                Registernummer nach § 34d GewO: D-EI6L-O9B02-64<br>
                Registernummer nach § 34f GewO: D-F-132-4HK1-31<br>
                Registernummer nach § 34i GewO: D-W-132-WXGS-92
            </p>

            <p>{{ __('Die Vermögensberater nehmen keine Kundengelder entgegen. Zahlungen erfolgen direkt von den Kunden an die jeweiligen Produktpartner.') }}</p>

            <h2>{{ __('Haftungshinweis:') }}</h2>
            <p>{{ __('Trotz sorgfältiger inhaltlicher Kontrolle übernehmen wir keine Haftung für die Inhalte externer Links. Für den Inhalt der verlinkten Seiten sind ausschließlich deren Betreiber verantwortlich.') }}</p>
        </div>
    </div>
</div>
@endsection
