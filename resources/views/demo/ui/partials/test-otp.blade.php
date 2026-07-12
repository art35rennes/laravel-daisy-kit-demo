<!-- OTP -->
<section class="space-y-4 rounded-box bg-base-200 p-6">
    <h2 class="text-lg font-medium">OTP</h2>
    <div class="flex flex-wrap items-end gap-6">
        <div class="space-y-2">
            <x-daisy::ui.advanced.label for="demo-otp" value="Code de vérification" />
            <x-daisy::ui.inputs.otp id="demo-otp" name="demo_otp" value="123456" color="primary" required />
        </div>
        <div class="space-y-2">
            <x-daisy::ui.advanced.label for="demo-otp-joined" value="Code court" />
            <x-daisy::ui.inputs.otp id="demo-otp-joined" name="demo_otp_joined" length="4" value="1234" :joined="true" size="sm" color="success" />
        </div>
        <div class="space-y-2">
            <x-daisy::ui.advanced.label for="demo-otp-alphanumeric" value="Code alphanumérique" />
            <x-daisy::ui.inputs.otp id="demo-otp-alphanumeric" name="demo_otp_alphanumeric" length="5" value="A7X2Q" :numeric="false" size="lg" />
        </div>
    </div>
</section>
