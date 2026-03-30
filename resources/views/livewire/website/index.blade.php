<div>
    <div class="p-6">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white dark:bg-zinc-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-2xl font-semibold mb-4">Website Settings</h2>
                    
                    <form wire:submit.prevent="saveSettings">
                        <div class="space-y-6">
                            <!-- Title -->
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                                <input type="text" wire:model="title" id="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-zinc-700 dark:border-zinc-600">
                                @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <!-- Meta Description -->
                            <div>
                                <label for="meta_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Meta Description</label>
                                <textarea wire:model="meta_description" id="meta_description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-zinc-700 dark:border-zinc-600"></textarea>
                                @error('meta_description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <!-- Tags Field -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Meta Tags</label>
                                <div id="tag-container" class="flex flex-wrap items-center border border-gray-300 rounded-lg p-2 mb-4">
                                    <input id="tag-input" type="text" class="flex-grow p-1 outline-none border-0" placeholder="Type a tag and press Enter">
                                </div>

                                <!-- Hidden input for Livewire -->
                                <input type="hidden" wire:model.lazy="tagsString" id="tags-hidden">
                                @error('tagsString') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <!-- fb_app_id -->
                            <div>
                                <label for="fb_app_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Facebook App Id</label>
                                <input type="text" wire:model="fb_app_id" id="fb_app_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-zinc-700 dark:border-zinc-600">
                                @error('fb_app_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <!-- Facebook URL -->
                            <div>
                                <label for="facebook_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Facebook URL</label>
                                <input type="text" wire:model="facebook_url" id="facebook_url" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-zinc-700 dark:border-zinc-600">
                                @error('facebook_url') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <!-- Twitter URL -->
                            <div>
                                <label for="twitter_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Twitter URL</label>
                                <input type="text" wire:model="twitter_url" id="twitter_url" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-zinc-700 dark:border-zinc-600">
                                @error('twitter_url') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <!-- Instagram URL -->
                            <div>
                                <label for="instagram_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Instagram URL</label>
                                <input type="text" wire:model="instagram_url" id="instagram_url" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-zinc-700 dark:border-zinc-600">
                                @error('instagram_url') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <!-- Reddit URL -->
                            <div>
                                <label for="reddit_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Reddit URL</label>
                                <input type="text" wire:model="reddit_url" id="reddit_url" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-zinc-700 dark:border-zinc-600">
                                @error('reddit_url') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <!-- Google News URL -->
                            <div>
                                <label for="google_news_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Google News URL</label>
                                <input type="text" wire:model="google_news_url" id="google_news_url" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-zinc-700 dark:border-zinc-600">
                                @error('google_news_url') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <!-- LinkedIn URL -->
                            <div>
                                <label for="linkedin_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300">LinkedIn URL</label>
                                <input type="text" wire:model="linkedin_url" id="linkedin_url" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-zinc-700 dark:border-zinc-600">
                                @error('linkedin_url') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <!-- Mailer -->
                            <div>
                                <label for="mailer" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Mail server</label>
                                <input type="text" wire:model="mailer" id="mailer" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-zinc-700 dark:border-zinc-600">
                                @error('mailer') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <!-- Host -->
                            <div>
                                <label for="host" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Mail Host</label>
                                <input type="text" wire:model="host" id="host" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-zinc-700 dark:border-zinc-600">
                                @error('host') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <!-- Port -->
                            <div>
                                <label for="port" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Mail Port</label>
                                <input type="text" wire:model="port" id="port" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-zinc-700 dark:border-zinc-600">
                                @error('port') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <!-- Username -->
                            <div>
                                <label for="username" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Mail Username</label>
                                <input type="text" wire:model="username" id="username" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-zinc-700 dark:border-zinc-600">
                                @error('username') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <!-- Password -->
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Mail Password</label>
                                <input type="text" wire:model="password" id="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-zinc-700 dark:border-zinc-600">
                                @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <!-- Encryption -->
                            <div>
                                <label for="encryption" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Mail Encryption</label>
                                <input type="text" wire:model="encryption" id="encryption" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-zinc-700 dark:border-zinc-600">
                                @error('encryption') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <!-- From Address -->
                            <div>
                                <label for="from_address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Mail From Address</label>
                                <input type="text" wire:model="from_address" id="from_address" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-zinc-700 dark:border-zinc-600">
                                @error('from_address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            
                            <!-- From Name -->
                            <div>
                                <label for="from_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Mail From Name</label>
                                <input type="text" wire:model="from_name" id="from_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-zinc-700 dark:border-zinc-600">
                                @error('from_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <!-- Terms -->
                            <div x-data x-init="
                                const summernoteTerms = $($refs.termsEditor).summernote({
                                    height: 200,
                                    callbacks: {
                                        onChange: (contents) => $wire.terms = contents
                                    }
                                });
                                $watch('$wire.terms', value => {
                                    if (value !== $($refs.termsEditor).summernote('code')) {
                                        $($refs.termsEditor).summernote('code', value);
                                    }
                                });
                            ">
                                <label for="terms" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Terms Page</label>
                                <div wire:ignore>
                                    <textarea x-ref="termsEditor">{!! $terms !!}</textarea>
                                </div>
                                @error('terms') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <!-- Privacy -->
                            <div x-data x-init="
                                const summernotePrivacy = $($refs.privacyEditor).summernote({
                                    height: 200,
                                    callbacks: {
                                        onChange: (contents) => $wire.privacy = contents
                                    }
                                });
                                $watch('$wire.privacy', value => {
                                    if (value !== $($refs.privacyEditor).summernote('code')) {
                                        $($refs.privacyEditor).summernote('code', value);
                                    }
                                });
                            ">
                                <label for="privacy" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Privacy Page</label>
                                <div wire:ignore>
                                    <textarea x-ref="privacyEditor">{!! $privacy !!}</textarea>
                                </div>
                                @error('privacy') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <!-- Contact -->
                            <div x-data x-init="
                                const summernoteContact = $($refs.contactEditor).summernote({
                                    height: 200,
                                    callbacks: {
                                        onChange: (contents) => $wire.contact = contents
                                    }
                                });
                                $watch('$wire.contact', value => {
                                    if (value !== $($refs.contactEditor).summernote('code')) {
                                        $($refs.contactEditor).summernote('code', value);
                                    }
                                });
                            ">
                                <label for="contact" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Contact Page</label>
                                <div wire:ignore>
                                    <textarea x-ref="contactEditor">{!! $contact !!}</textarea>
                                </div>
                                @error('contact') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <!-- About -->
                            <div x-data x-init="
                                const summernoteAbout = $($refs.aboutEditor).summernote({
                                    height: 200,
                                    callbacks: {
                                        onChange: (contents) => $wire.about = contents
                                    }
                                });
                                $watch('$wire.about', value => {
                                    if (value !== $($refs.aboutEditor).summernote('code')) {
                                        $($refs.aboutEditor).summernote('code', value);
                                    }
                                });
                            ">
                                <label for="about" class="block text-sm font-medium text-gray-700 dark:text-gray-300">About Page</label>
                                <div wire:ignore>
                                    <textarea x-ref="aboutEditor">{!! $about !!}</textarea>
                                </div>
                                @error('about') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <!-- Editor -->
                            <div>
                                <label for="editor" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Editor</label>
                                <input type="text" wire:model="editor" id="editor" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-zinc-700 dark:border-zinc-600">
                                @error('editor') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <!-- Save Button --> 
                            <div>
                                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 ">Save Settings</button>
                            </div>
                        </div>
                    </form>

                    <!-- Tag Script -->
                    <script>
                        function initializeTagsField() {
                            const tagContainer = document.getElementById('tag-container');
                            const tagInput = document.getElementById('tag-input');
                            const hiddenInput = document.getElementById('tags-hidden');
                    
                            if (!tagContainer || !tagInput || !hiddenInput) return;
                    
                            let tags = hiddenInput.value
                                ? hiddenInput.value.split(',').map(tag => tag.trim()).filter(tag => tag !== '')
                                : [];
                    
                            function renderTags() {
                                tagContainer.querySelectorAll('.tag').forEach(tag => tag.remove());
                    
                                tags.forEach((tag, index) => {
                                    const tagElement = document.createElement('div');
                                    tagElement.className = 'tag flex items-center bg-blue-100 text-blue-800 px-2 py-1 rounded mr-2 mb-2';
                                    tagElement.innerHTML = `
                                        <span>${tag}</span>
                                        <button type="button" class="ml-2 text-blue-500 hover:text-blue-700 font-bold" data-index="${index}">
                                            &times;
                                        </button>
                                    `;
                                    tagContainer.insertBefore(tagElement, tagInput);
                                });
                    
                                hiddenInput.value = tags.join(',');
                                hiddenInput.dispatchEvent(new Event('input'));
                            }
                    
                            renderTags();
                    
                            tagInput.addEventListener('keydown', function (e) {
                                if (e.key === 'Enter') {
                                    e.preventDefault();
                                    const newTag = tagInput.value.trim();
                                    if (newTag !== '' && !tags.includes(newTag)) {
                                        tags.push(newTag);
                                        renderTags();
                                    }
                                    tagInput.value = '';
                                }
                            });
                    
                            tagContainer.addEventListener('click', function (e) {
                                if (e.target.tagName === 'BUTTON') {
                                    const index = e.target.getAttribute('data-index');
                                    tags.splice(index, 1);
                                    renderTags();
                                }
                            });
                        }
                    
                        document.addEventListener('livewire:load', () => {
                            initializeTagsField();
                        });
                    
                        document.addEventListener('livewire:navigated', () => {
                            setTimeout(() => {
                                initializeTagsField();
                            }, 100);
                        });
                    
                        // Important: Re-initialize after image upload or input
                        // Livewire.hook('message.processed', (message, component) => {
                        //     initializeTagsField();
                        // });

                        Livewire.hook('message.processed', () => {
                            setTimeout(() => {
                                initializeTagsField();
                            }, 50);
                        });
                    </script>
                    
                </div>
            </div>
        </div>
    </div>
</div>
