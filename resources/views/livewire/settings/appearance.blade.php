<?php

use Livewire\Volt\Component;

new class extends Component {
    // No PHP needed for theme logic
}; ?>

<section
    class="w-full"
    x-data="{
        // This initializes Alpine.js state for theme mode.
        // It reads from localStorage first, then checks system preference if nothing is saved.
        themeMode: localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'system' : 'light'),

        init() {
            // Initial application of the theme (redundant with <head> script but good for robustness)
            this.applyTheme(this.themeMode);

            // Watch for changes in `themeMode` (when user clicks a radio button)
            this.$watch('themeMode', value => {
                this.applyTheme(value);
                localStorage.setItem('theme', value); // Save preference to localStorage
            });

            // Listen for OS theme changes if 'system' mode is active
            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', event => {
                if (this.themeMode === 'system') {
                    this.applyTheme('system');
                }
            });
        },

        // Function to apply the 'dark' class to the <html> element
        applyTheme(mode) {
            if (mode === 'dark') {
                document.documentElement.classList.add('dark');
            } else if (mode === 'light') {
                document.documentElement.classList.remove('dark');
            } else if (mode === 'system') {
                if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            }
        }
    }"
    >
    {{-- Your settings-heading and layout components --}}
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Appearance')" :subheading="__('Update the appearance settings for your account')">
        <flux:radio.group x-data variant="segmented" x-model="themeMode"> {{-- Ensure x-model points to themeMode --}}
            <flux:radio value="light" icon="sun">{{ __('Light') }}</flux:radio>
            <flux:radio value="dark" icon="moon">{{ __('Dark') }}</flux:radio>
            <flux:radio value="system" icon="computer-desktop">{{ __('System') }}</flux:radio>
        </flux:radio.group>
    </x-settings.layout>
</section>