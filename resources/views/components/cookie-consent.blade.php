<!-- Cookie Consent Banner -->
<div x-data="{
    showBanner: !localStorage.getItem('cookie-consent'),
    showSettings: false,
    acceptAll() {
        localStorage.setItem('cookie-consent', 'all');
        this.showBanner = false;
    },
    acceptNecessary() {
        localStorage.setItem('cookie-consent', 'necessary');
        this.showBanner = false;
    },
    showSettingsModal() {
        this.showSettings = true;
    },
    saveSettings() {
        const analytics = document.getElementById('analytics-cookies').checked;
        const marketing = document.getElementById('marketing-cookies').checked;
        
        const consent = {
            necessary: true,
            analytics: analytics,
            marketing: marketing
        };
        
        localStorage.setItem('cookie-consent', JSON.stringify(consent));
        this.showSettings = false;
        this.showBanner = false;
    }
}" 
@edit-cookies.window="showSettings = true"
class="cookie-consent">
    
    <!-- Cookie Banner -->
    <div x-show="showBanner" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform translate-y-full"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100 transform translate-y-0"
         x-transition:leave-end="opacity-0 transform translate-y-full"
         class="fixed bottom-0 left-0 right-0 z-50 bg-slate-900 text-white p-4 shadow-lg">
        
        <div class="max-w-6xl mx-auto">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div class="flex-1">
                    <h3 class="font-semibold mb-2">Cookie-Einstellungen</h3>
                    <p class="text-sm text-slate-300 leading-relaxed">
                        Wir verwenden Cookies, um Ihnen die bestmögliche Nutzung unserer Website zu ermöglichen. 
                        Einige Cookies sind technisch notwendig, andere helfen uns, unser Angebot zu verbessern.
                        <a href="/datenschutz" class="text-golden-amber-400 hover:text-golden-amber-300 underline ml-1">
                            Mehr erfahren
                        </a>
                    </p>
                </div>
                
                <div class="flex flex-col sm:flex-row gap-2 min-w-fit">
                    <button @click="showSettingsModal()" 
                            class="px-4 py-2 text-sm border border-slate-600 text-slate-300 hover:bg-slate-800 rounded-lg transition-colors duration-200">
                        Einstellungen
                    </button>
                    <button @click="acceptNecessary()" 
                            class="px-4 py-2 text-sm border border-slate-600 text-slate-300 hover:bg-slate-800 rounded-lg transition-colors duration-200">
                        Nur Notwendige
                    </button>
                    <button @click="acceptAll()" 
                            class="px-4 py-2 text-sm bg-science-blue-600 hover:bg-science-blue-700 text-white rounded-lg transition-colors duration-200">
                        Alle akzeptieren
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Cookie Settings Modal -->
    <div x-show="showSettings" 
         x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 overflow-y-auto">
        
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-black bg-opacity-50" @click="showSettings = false"></div>
        
        <!-- Modal -->
        <div class="flex min-h-screen items-center justify-center p-4">
            <div class="relative bg-white rounded-xl shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto"
                 @click.stop>
                
                <!-- Header -->
                <div class="flex items-center justify-between p-6 border-b border-slate-200">
                    <h2 class="text-xl font-semibold text-slate-900">Cookie-Einstellungen</h2>
                    <button @click="showSettings = false" 
                            class="p-2 hover:bg-slate-100 rounded-lg transition-colors duration-200">
                        <x-heroicon-o-x-mark class="w-5 h-5" />
                    </button>
                </div>
                
                <!-- Content -->
                <div class="p-6 space-y-6">
                    <p class="text-slate-600">
                        Wählen Sie aus, welche Cookies Sie zulassen möchten. Sie können diese Einstellungen jederzeit ändern.
                    </p>
                    
                    <!-- Cookie Categories -->
                    <div class="space-y-4">
                        <!-- Necessary Cookies -->
                        <div class="flex items-start justify-between p-4 bg-slate-50 rounded-lg">
                            <div class="flex-1">
                                <h3 class="font-medium text-slate-900 mb-1">Notwendige Cookies</h3>
                                <p class="text-sm text-slate-600">
                                    Diese Cookies sind für das ordnungsgemäße Funktionieren der Website erforderlich.
                                </p>
                            </div>
                            <div class="ml-4">
                                <input type="checkbox" 
                                       id="necessary-cookies"
                                       checked 
                                       disabled
                                       class="w-4 h-4 text-science-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-science-blue-500 focus:ring-2">
                                <label for="necessary-cookies" class="sr-only">Notwendige Cookies</label>
                            </div>
                        </div>
                        
                        <!-- Analytics Cookies -->
                        <div class="flex items-start justify-between p-4 bg-slate-50 rounded-lg">
                            <div class="flex-1">
                                <h3 class="font-medium text-slate-900 mb-1">Analyse-Cookies</h3>
                                <p class="text-sm text-slate-600">
                                    Helfen uns zu verstehen, wie Besucher mit unserer Website interagieren.
                                </p>
                            </div>
                            <div class="ml-4">
                                <input type="checkbox" 
                                       id="analytics-cookies"
                                       class="w-4 h-4 text-science-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-science-blue-500 focus:ring-2">
                                <label for="analytics-cookies" class="sr-only">Analyse-Cookies</label>
                            </div>
                        </div>
                        
                        <!-- Marketing Cookies -->
                        <div class="flex items-start justify-between p-4 bg-slate-50 rounded-lg">
                            <div class="flex-1">
                                <h3 class="font-medium text-slate-900 mb-1">Marketing-Cookies</h3>
                                <p class="text-sm text-slate-600">
                                    Werden verwendet, um Ihnen relevante Werbung zu zeigen.
                                </p>
                            </div>
                            <div class="ml-4">
                                <input type="checkbox" 
                                       id="marketing-cookies"
                                       class="w-4 h-4 text-science-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-science-blue-500 focus:ring-2">
                                <label for="marketing-cookies" class="sr-only">Marketing-Cookies</label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Footer -->
                <div class="flex justify-between items-center p-6 border-t border-slate-200">
                    <a href="/datenschutz" 
                       class="text-sm text-science-blue-600 hover:text-science-blue-700 underline">
                        Datenschutzerklärung lesen
                    </a>
                    <div class="flex gap-3">
                        <button @click="showSettings = false" 
                                class="px-4 py-2 text-sm border border-slate-300 text-slate-700 hover:bg-slate-50 rounded-lg transition-colors duration-200">
                            Abbrechen
                        </button>
                        <button @click="saveSettings()" 
                                class="px-4 py-2 text-sm bg-science-blue-600 hover:bg-science-blue-700 text-white rounded-lg transition-colors duration-200">
                            Einstellungen speichern
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>