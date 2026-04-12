<!-- Sign -->
<section class="space-y-4 bg-base-200 p-6 rounded-box">
    <h2 class="text-lg font-medium">Sign (Signature)</h2>
    <p class="text-sm opacity-70">Composant de signature responsive avec support tactile et souris</p>
    
    <x-daisy::ui.layout.grid-layout gap="4" align="start" class="min-w-0">
        <!-- Signature par défaut -->
        <div class="col-12 col-sm-6 flex min-w-0 flex-col gap-2">
            <x-daisy::ui.advanced.label value="Signature par défaut (320×120)" />
            <x-daisy::ui.inputs.sign name="signature1" :width="320" :height="120" />
        </div>

        <!-- Signature avec dimensions personnalisées -->
        <div class="col-12 col-sm-6 flex min-w-0 flex-col gap-2">
            <x-daisy::ui.advanced.label value="Signature personnalisée (360×160)" />
            <x-daisy::ui.inputs.sign 
                name="signature2" 
                :width="360" 
                :height="160"
                pen-color="#0066cc" />
        </div>

        <!-- Signature responsive -->
        <div class="col-12 col-sm-6 flex min-w-0 flex-col gap-2">
            <x-daisy::ui.advanced.label value="Signature responsive (s'adapte à la largeur)" />
            <x-daisy::ui.inputs.sign 
                name="signature3" 
                :width="320" 
                :height="120"
                :responsive="true" />
        </div>

        <!-- Signature sans boutons d'action -->
        <div class="col-12 col-sm-6 flex min-w-0 flex-col gap-2">
            <x-daisy::ui.advanced.label value="Signature sans boutons d'action" />
            <x-daisy::ui.inputs.sign 
                name="signature4" 
                :width="320"
                :height="120"
                :show-actions="false" />
        </div>

        <!-- Signature avec format SVG -->
        <div class="col-12 col-sm-6 flex min-w-0 flex-col gap-2">
            <x-daisy::ui.advanced.label value="Signature avec téléchargement SVG" />
            <x-daisy::ui.inputs.sign 
                name="signature5" 
                :width="320"
                :height="120"
                download-format="svg"
                download-filename="ma-signature" />
        </div>

        <!-- Signature désactivée -->
        <div class="col-12 col-sm-6 flex min-w-0 flex-col gap-2">
            <x-daisy::ui.advanced.label value="Signature désactivée" />
            <x-daisy::ui.inputs.sign 
                name="signature6" 
                :width="320"
                :height="120"
                :disabled="true" />
        </div>
    </x-daisy::ui.layout.grid-layout>
</section>

