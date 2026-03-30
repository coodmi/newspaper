<div>
    <div class="p-6">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white dark:bg-zinc-600 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-2xl font-semibold mb-4">Website Settings</h2>

                    <form wire:submit.prevent="saveSettings">
                        <div class="space-y-6">
                            <!-- Favicon -->
                            <div>
                                <label for="favicon"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Favicon</label>
                                <input type="file" wire:model="favicon" id="favicon"
                                    class="mt-1 block w-full text-sm text-gray-500 file:bg-indigo-50 file:text-indigo-700 dark:file:bg-zinc-700 dark:file:text-zinc-300">
                                @error('favicon') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                <div class="mt-2">
                                    @if($favicon)
                                    <img src="{{ $favicon->temporaryUrl() }}" class="h-8 w-8">
                                    @elseif($temp_favicon)
                                    <img src="{{ $temp_favicon }}" class="h-8 w-8">
                                    @endif
                                </div>
                            </div>

                            <!-- Logo -->
                            <div>
                                <label for="logo"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Logo</label>
                                <input type="file" wire:model="logo" id="logo"
                                    class="mt-1 block w-full text-sm text-gray-500 file:bg-indigo-50 file:text-indigo-700 dark:file:bg-zinc-700 dark:file:text-zinc-300">
                                @error('logo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                <div class="mt-2">
                                    @if($logo)
                                    <img src="{{ $logo->temporaryUrl() }}" class="h-32 w-auto">
                                    @elseif($temp_logo)
                                    <img src="{{ $temp_logo }}" class="h-32 w-auto">
                                    @endif
                                </div>
                            </div>


                            <!-- Save Button -->
                            <div class="flex justify-end">
                                <button type="submit"
                                    class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 ">Save
                                    Settings</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>