@extends('components.layouts.legal')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-12 lg:py-16">
    <div class="animate-fade-in">
        <x-ui.heading level="1" class="mb-8 ltr:text-left rtl:text-right">{{ __('Datenschutzerklärung') }}</x-ui.heading>

        <div class="prose prose-slate prose-lg max-w-none ltr:prose rtl:prose-rtl">
        <h2>{{ __('1. Datenschutz auf einen Blick') }}</h2>
        
        <h3>{{ __('Allgemeine Hinweise') }}</h3>
        <p>{{ __('Die folgenden Hinweise geben einen einfachen Überblick darüber, was mit Ihren personenbezogenen Daten passiert, wenn Sie diese Website besuchen.') }} {{ __('Personenbezogene Daten sind alle Daten, mit denen Sie persönlich identifiziert werden können.') }} {{ __('Ausführliche Informationen zum Thema Datenschutz entnehmen Sie unserer unter diesem Text aufgeführten Datenschutzerklärung.') }}</p>

        <h3>{{ __('Datenerfassung auf dieser Website') }}</h3>
        <h4>{{ __('Wer ist verantwortlich für die Datenerfassung auf dieser Website?') }}</h4>
        <p>{{ __('Die Datenverarbeitung auf dieser Website erfolgt durch den Websitebetreiber.') }} {{ __('Dessen Kontaktdaten können Sie dem Impressum dieser Website entnehmen.') }}</p>

        <h4>{{ __('Wie erfassen wir Ihre Daten?') }}</h4>
        <p>{{ __('Ihre Daten werden zum einen dadurch erhoben, dass Sie uns diese mitteilen.') }} {{ __('Hierbei kann es sich z. B. um Daten handeln, die Sie in ein Kontaktformular eingeben.') }}</p>

        <p>{{ __('Andere Daten werden automatisch oder nach Ihrer Einwilligung beim Besuch der Website durch unsere IT-Systeme erfasst. Das sind vor allem technische Daten (z. B. Internetbrowser, Betriebssystem oder Uhrzeit des Seitenaufrufs). Die Erfassung dieser Daten erfolgt automatisch, sobald Sie diese Website betreten.') }}</p>

        <h4>{{ __('Wofür nutzen wir Ihre Daten?') }}</h4>
        <p>{{ __('Ein Teil der Daten wird erhoben, um eine fehlerfreie Bereitstellung der Website zu gewährleisten. Andere Daten können zur Analyse Ihres Nutzerverhaltens verwendet werden.') }}</p>

        <h4>{{ __('Welche Rechte haben Sie bezüglich Ihrer Daten?') }}</h4>
        <p>{{ __('Sie haben jederzeit das Recht, unentgeltlich Auskunft über Herkunft, Empfänger und Zweck Ihrer gespeicherten personenbezogenen Daten zu erhalten.') }} {{ __('Sie haben außerdem ein Recht, die Berichtigung oder Löschung dieser Daten zu verlangen. Wenn Sie eine Einwilligung zur Datenverarbeitung erteilt haben, können Sie diese Einwilligung jederzeit für die Zukunft widerrufen. Außerdem haben Sie das Recht, unter bestimmten Umständen die Einschränkung der Verarbeitung Ihrer personenbezogenen Daten zu verlangen. Des Weiteren steht Ihnen ein Beschwerderecht bei der zuständigen Aufsichtsbehörde zu.') }}</p>

        <p>{{ __('Hierzu sowie zu weiteren Fragen zum Thema Datenschutz können Sie sich jederzeit an uns wenden.') }}</p>

        <h2>{{ __('2. Hosting') }}</h2>
        <p>{{ __('Wir hosten die Inhalte unserer Website bei folgendem Anbieter:') }}</p>

        <h3>{{ __('Externes Hosting') }}</h3>
        <p>{{ __('Diese Website wird extern gehostet.') }} {{ __('Die personenbezogenen Daten, die auf dieser Website erfasst werden, werden auf den Servern des Hosters / der Hoster gespeichert. Hierbei kann es sich v. a. um IP-Adressen, Kontaktanfragen, Meta- und Kommunikationsdaten, Vertragsdaten, Kontaktdaten, Namen, Websitezugriffe und sonstige Daten, die über eine Website generiert werden, handeln.') }}</p>

        <p>{{ __('Das externe Hosting erfolgt zum Zwecke der Vertragserfüllung gegenüber unseren potenziellen und bestehenden Kunden (Art. 6 Abs. 1 lit. b DSGVO) und im Interesse einer sicheren, schnellen und effizienten Bereitstellung unseres Online-Angebots durch einen professionellen Anbieter (Art. 6 Abs. 1 lit. f DSGVO). Sofern eine entsprechende Einwilligung abgefragt wurde, erfolgt die Verarbeitung ausschließlich auf Grundlage von Art. 6 Abs. 1 lit. a DSGVO und § 25 Abs. 1 TTDSG, soweit die Einwilligung die Speicherung von Cookies oder den Zugriff auf Informationen im Endgerät des Nutzers (z. B. Device-Fingerprinting) im Sinne des TTDSG umfasst. Die Einwilligung ist jederzeit widerrufbar.') }}</p>

        <h2>{{ __('3. Allgemeine Hinweise und Pflichtinformationen') }}</h2>
        
        <h3>{{ __('Datenschutz') }}</h3>
        <p>{{ __('Die Betreiber dieser Seiten nehmen den Schutz Ihrer persönlichen Daten sehr ernst.') }} {{ __('Wir behandeln Ihre personenbezogenen Daten vertraulich und entsprechend den gesetzlichen Datenschutzbestimmungen sowie dieser Datenschutzerklärung.') }}</p>

        <p>{{ __('Wenn Sie diese Website benutzen, werden verschiedene personenbezogene Daten erhoben. Personenbezogene Daten sind Daten, mit denen Sie persönlich identifiziert werden können. Die vorliegende Datenschutzerklärung erläutert, welche Daten wir erheben und wofür wir sie nutzen. Sie erläutert auch, wie und zu welchem Zweck das geschieht.') }}</p>

        <p>{{ __('Wir weisen darauf hin, dass die Datenübertragung im Internet (z. B. bei der Kommunikation per E-Mail) Sicherheitslücken aufweisen kann. Ein lückenloser Schutz der Daten vor dem Zugriff durch Dritte ist nicht möglich.') }}</p>

        <h3>{{ __('Hinweis zur verantwortlichen Stelle') }}</h3>
        <p>{{ __('Die verantwortliche Stelle für die Datenverarbeitung auf dieser Website ist:') }}</p>

        <p>
            Abdelaziz Kallel<br>
            {{ __('Deutsche Vermögensberatung') }}<br>
            {{ __('E-Mail') }}: info@abdelaziz-kallel.de
        </p>

        <p>{{ __('Verantwortliche Stelle ist die natürliche oder juristische Person, die allein oder gemeinsam mit anderen über die Zwecke und Mittel der Verarbeitung von personenbezogenen Daten entscheidet.') }}</p>

        <h3>{{ __('Speicherdauer') }}</h3>
        <p>{{ __('Soweit innerhalb dieser Datenschutzerklärung keine speziellere Speicherdauer genannt wurde, verbleiben Ihre personenbezogenen Daten bei uns, bis der Zweck für die Datenverarbeitung entfällt. Wenn Sie ein berechtigtes Löschersuchen geltend machen oder eine Einwilligung zur Datenverarbeitung widerrufen, werden Ihre Daten gelöscht, sofern wir keine anderen rechtlich zulässigen Gründe für die Speicherung Ihrer personenbezogenen Daten haben (z. B. steuer- oder handelsrechtliche Aufbewahrungsfristen); im letztgenannten Fall erfolgt die Löschung nach Fortfall dieser Gründe.') }}</p>

        <h2>{{ __('4. Datenerfassung auf dieser Website') }}</h2>

        <h3>{{ __('Cookies') }}</h3>
        <p>{{ __('Unsere Internetseiten verwenden so genannte „Cookies". Cookies sind kleine Textdateien und richten auf Ihrem Endgerät keinen Schaden an. Sie werden entweder vorübergehend für die Dauer einer Sitzung (Session-Cookies) oder dauerhaft (dauerhafte Cookies) auf Ihrem Endgerät gespeichert. Session-Cookies werden nach Ende Ihres Besuchs automatisch gelöscht. Dauerhafte Cookies bleiben auf Ihrem Endgerät gespeichert, bis Sie diese selbst löschen oder eine automatische Löschung durch Ihren Webbrowser erfolgt.') }}</p>

        <h3>{{ __('Kontaktformular') }}</h3>
        <p>{{ __('Wenn Sie uns per Kontaktformular Anfragen zukommen lassen, werden Ihre Angaben aus dem Anfrageformular inklusive der von Ihnen dort angegebenen Kontaktdaten zwecks Bearbeitung der Anfrage und für den Fall von Anschlussfragen bei uns gespeichert. Diese Daten geben wir nicht ohne Ihre Einwilligung weiter.') }}</p>

        <p>{{ __('Die Verarbeitung dieser Daten erfolgt auf Grundlage von Art. 6 Abs. 1 lit. b DSGVO, sofern Ihre Anfrage mit der Erfüllung eines Vertrags zusammenhängt oder zur Durchführung vorvertraglicher Maßnahmen erforderlich ist. In allen übrigen Fällen beruht die Verarbeitung auf unserem berechtigten Interesse an der effektiven Bearbeitung der an uns gerichteten Anfragen (Art. 6 Abs. 1 lit. f DSGVO) oder auf Ihrer Einwilligung (Art. 6 Abs. 1 lit. a DSGVO) sofern diese abgefragt wurde.') }}</p>

        <h2>{{ __('5. Ihre Rechte') }}</h2>
        <p>{{ __('Sie haben folgende Rechte:') }}</p>
        
        <ul>
            <li>{{ __('Recht auf Auskunft über Ihre bei uns gespeicherten personenbezogenen Daten') }}</li>
            <li>{{ __('Recht auf Berichtigung unrichtiger oder unvollständiger Daten') }}</li>
            <li>{{ __('Recht auf Löschung Ihrer bei uns gespeicherten Daten') }}</li>
            <li>{{ __('Recht auf Einschränkung der Datenverarbeitung') }}</li>
            <li>{{ __('Recht auf Datenübertragbarkeit') }}</li>
            <li>{{ __('Recht auf Widerspruch gegen die Verarbeitung') }}</li>
            <li>{{ __('Recht auf Widerruf Ihrer Einwilligung') }}</li>
        </ul>

        <p>{{ __('Für die Ausübung Ihrer Rechte wenden Sie sich bitte an:') }} info@abdelaziz-kallel.de</p>

        <h2>{{ __('6. Beschwerderecht') }}</h2>
        <p>{{ __('Sie haben das Recht, sich bei einer Aufsichtsbehörde über die Verarbeitung Ihrer personenbezogenen Daten durch uns zu beschweren.') }}</p>
        </div>
    </div>
</div>
@endsection