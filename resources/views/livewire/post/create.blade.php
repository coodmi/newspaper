<section class="py-12">
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-zinc-700 border dark:border-zinc-600 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl dark:text-white font-semibold">Create Post</h2>
                    <flux:button type="button" href="{{ route('posts.index') }}" wire:navigate variant="filled"
                        icon="arrow-left"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                        Back to Posts
                    </flux:button>
                </div>

                <form wire:submit.prevend="submit" enctype="multipart/form-data" class="space-y-6">
                    <div class="grid grid-cols-1 gap-6">

                        <flux:field>
                            <flux:label>Title</flux:label>
                            <flux:input wire:model="title" type="text" />
                            <flux:error name="title" />
                        </flux:field>

                        {{-- <flux:field>
                            <flux:label>Slug</flux:label>
                            <flux:input wire:model.live="slug" type="text" />
                            <flux:error name="slug" />
                        </flux:field> --}}

                        <flux:field>
                            <flux:label>Category</flux:label>
                            <flux:select wire:model="category_id">
                                <flux:select.option value="">Select Category</flux:select.option>
                                @foreach ($categories as $cat)
                                <flux:select.option value="{{ $cat->id }}">{{ $cat->name }}</flux:select.option>
                                @endforeach
                            </flux:select>
                            <flux:error name="category_id" />
                        </flux:field>

                        <flux:field>
                            <flux:label>Poll (Optional)</flux:label>
                            <flux:select wire:model="poll_id">
                                <flux:select.option value="">No Poll</flux:select.option>
                                @foreach ($polls as $poll)
                                <flux:select.option value="{{ $poll->id }}">{{ $poll->question }}</flux:select.option>
                                @endforeach
                            </flux:select>
                            <flux:error name="poll_id" />
                        </flux:field>

                        <flux:field>
                            <flux:label>Sub Title</flux:label>
                            <flux:input wire:model="sub_title" type="text" />
                            <flux:error name="sub_title" />
                        </flux:field>

                        <flux:field>
                            <flux:label>Summary</flux:label>
                            <flux:textarea wire:model="summary" rows="3" />
                            <flux:error name="summary" />
                        </flux:field>

                        <flux:field>
                            {{-- <flux:label>Content</flux:label>
                            <flux:textarea wire:model="content" rows="5" /> --}}
                            <div x-data x-init="
                                    const summernote = $($refs.editor).summernote({
                                        height: 300,
                                        callbacks: {
                                            onChange: (contents) => $wire.content = contents
                                        }
                                    });
                            
                                    $watch('$wire.content', value => {
                                        if (value !== $($refs.editor).summernote('code')) {
                                            $($refs.editor).summernote('code', value);
                                        }
                                    });
                                ">
                                <div wire:ignore>
                                    <textarea x-ref="editor">{!! $content !!}</textarea>
                                </div>
                            </div>
                                <flux:error name="content" />
                        </flux:field>

                        <flux:field>
                            <flux:label>Featured Image</flux:label>
                            <label for="file-upload"
                                class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                <div class="space-y-1 text-center cursor-pointer">
                                    @if ($featured_image)
                                    <div class="mt-2 w-full flex justify-center">
                                        {{-- Display the uploaded image --}}
                                        <img src="{{ $featured_image->temporaryUrl() }}"
                                            class="h-[200px] w-[300px] object-cover rounded-lg ">
                                    </div>
                                    @else
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                        viewBox="0 0 48 48" aria-hidden="true">
                                        <path
                                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    @endif
                                    <div class="flex text-sm text-gray-600 justify-center">
                                        <div
                                            class="relative cursor-pointer bg-white rounded-md font-medium focus-within:outline-none">

                                            <span>Upload a file</span>
                                            <input id="file-upload" type="file" wire:model="featured_image"
                                                class="sr-only">
                                        </div>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <small>Image must be 600x400 px</small>
                                    <p class="text-xs text-gray-500">PNG, JPG, GIF up to 1MB</p>
                                </div>
                            </label>
                            <flux:error name="featured_image" />
                        </flux:field>

                        <flux:field>
                            <flux:label>Image Caption</flux:label>
                            <flux:input wire:model="image_caption" type="text" />
                            <flux:error name="image_caption" />
                        </flux:field>

                        <flux:field>
                            <flux:label>Video URL</flux:label>
                            <small>Only YouTube Urls are allowed</small>
                            <flux:input wire:model="video_url" type="url" placeholder="https://www.youtube.com/watch?v=xxxxxxxxxx" />
                            <flux:error name="video_url" />
                        </flux:field>


                        <flux:field>
                            <flux:label>Status</flux:label>
                            <flux:select wire:model="status">
                                <flux:select.option value="draft">Draft</flux:select.option>
                                <flux:select.option value="pending">Pending</flux:select.option>
                                @canany(['post.maintenance', 'post.published'])
                                    <flux:select.option value="published">Published</flux:select.option>
                                    <flux:select.option value="archived">Archived</flux:select.option>
                                @endcanany
                            </flux:select>
                            <flux:error name="status" />
                        </flux:field>

                        <div class="grid grid-cols-4 gap-2">
                            <flux:field>
                                <flux:label>Is Featured</flux:label>
                                <flux:select wire:model="is_featured">
                                    <flux:select.option value="">Select option</flux:select.option>
                                    <flux:select.option value="0">No</flux:select.option>
                                    <flux:select.option value="1">Yes</flux:select.option>
                                </flux:select>
                            </flux:field>

                            <flux:field>
                                <flux:label>Is Breaking</flux:label>
                                <flux:select wire:model="is_breaking">
                                    <flux:select.option value="">Select option</flux:select.option>
                                    <flux:select.option value="0">No</flux:select.option>
                                    <flux:select.option value="1">Yes</flux:select.option>
                                </flux:select>
                            </flux:field>

                            <flux:field>
                                <flux:label>Is Slider</flux:label>
                                <flux:select wire:model="is_slider">
                                    <flux:select.option value="0">No</flux:select.option>
                                    <flux:select.option value="1">Main</flux:select.option>
                                    <flux:select.option value="2">Sidebar</flux:select.option>
                                </flux:select>
                            </flux:field>

                            <flux:field>
                                <flux:label>Section</flux:label>
                                <flux:input wire:model="section" type="number" />
                                <flux:error name="section" />
                            </flux:field>
                        </div>

                        <flux:field>
                            <flux:label>Published At</flux:label>
                            <flux:input type="datetime-local" wire:model="published_at" />
                            <flux:error name="published_at" />

                        </flux:field>

                        <flux:label>Keywords or Tags</flux:label>
                        <div id="tag-container"
                            class="flex flex-wrap items-center border border-gray-300 rounded-lg p-2 mb-4">

                            <!-- Tags will be added here dynamically -->
                            <input id="tag-input" type="text" class="flex-grow p-1 outline-none border-0"
                                placeholder="Type a tag and press Enter" />
                        </div>

                        <!-- Hidden input to store tags as CSV for Livewire -->
                        <input type="hidden" wire:model="tagsString" id="tags-hidden" value="">
                        <flux:error name="tagsString" />

                        <flux:field>
                            <flux:label>Meta Title</flux:label>
                            <flux:input wire:model="meta_title" type="text" />
                            <flux:error name="meta_title" />
                        </flux:field>

                        <flux:field>
                            <flux:label>Meta Description</flux:label>
                            <flux:textarea wire:model="meta_description" rows="3" />
                            <flux:error name="meta_description" />
                        </flux:field>

                    </div>

                    <div class="flex justify-end gap-3">
                        <flux:button type="button" wire:click="$refresh" variant="danger">
                            Reset
                        </flux:button>
                        <flux:button type="submit" variant="primary">
                            Create Post
                        </flux:button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function initializeTagsField() {
            const tagContainer = document.getElementById('tag-container');
            const tagInput = document.getElementById('tag-input');
            const hiddenInput = document.getElementById('tags-hidden');

            if (!tagContainer || !tagInput || !hiddenInput) return;

            // Prevent duplicate initialization
            if (tagContainer.getAttribute('data-initialized') === 'true') {
                return;
            }

            tagContainer.setAttribute('data-initialized', 'true');

            // Initialize tags array
            let tags = hiddenInput.value
                ? hiddenInput.value.split(',').map(tag => tag.trim()).filter(tag => tag !== '')
                : [];

            function renderTags() {
                // Remove existing tags
                tagContainer.querySelectorAll('.tag').forEach(tag => tag.remove());

                // Render tags
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

                // Update hidden input
                hiddenInput.value = tags.join(',');
                hiddenInput.dispatchEvent(new Event('input'));
            }

            renderTags(); // Initial render

            // Add tag on Enter key
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

            // Remove tag on button click
            tagContainer.addEventListener('click', function (e) {
                if (e.target.tagName === 'BUTTON') {
                    const index = e.target.getAttribute('data-index');
                    tags.splice(index, 1);
                    renderTags();
                }
            });
        }

        // Initial run
        initializeTagsField();

        // Run on Livewire SPA navigation
        document.addEventListener('livewire:navigated', () => {
            setTimeout(() => {
                initializeTagsField();
            }, 100);
        });

        // Run on Livewire DOM updated (important for reactive fields!)
        document.addEventListener('livewire:updated', () => {
            setTimeout(() => {
                initializeTagsField();
            }, 50);
        });
    </script>
</section>