<section class="py-12">
   <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-grey-50 dark:bg-zinc-700 overflow-hidden border dark:border-zinc-700 sm:rounded-lg">
         <div class="p-6 text-gray-900">
            <h2 class="text-2xl dark:text-white font-semibold mb-6">Create Poll</h2>
            <form wire:submit.prevent="submit" class="space-y-6">
               <flux:field>
                  <flux:label>Question</flux:label>
                  <flux:input type="text" wire:model="question" />
                  <flux:error name="question" />
               </flux:field>
               <flux:field>
                  <flux:label>Status</flux:label>
                  <flux:select wire:model="status">
                     <option value="upcoming">Upcoming</option>
                     <option value="active">Active</option>
                     <option value="closed">Closed</option>
                  </flux:select>
                  <flux:error name="status" />
               </flux:field>
               <div class="flex gap-4">
                  <flux:field class="flex-1">
                     <flux:label>Start Date</flux:label>
                     <flux:input type="datetime-local" wire:model="start_date" />
                     <flux:error name="start_date" />
                  </flux:field>
                  <flux:field class="flex-1">
                     <flux:label>End Date</flux:label>
                     <flux:input type="datetime-local" wire:model="end_date" />
                     <flux:error name="end_date" />
                  </flux:field>
               </div>
               <flux:field>
                  <flux:label class="mb-2">Poll Options</flux:label>
                  <div class="space-y-2">
                     @foreach ($options as $index => $option)
                        <div class="flex items-center gap-2">
                           <flux:input type="text" wire:model="options.{{ $index }}" placeholder="Option text" class="flex-1" />
                           @if (count($options) > 2)
                              <flux:button type="button"
                                           wire:click="removeOption({{ $index }})"
                                           variant="danger"
                                           size="sm">
                                 Remove
                              </flux:button>
                           @endif
                        </div>
                     @endforeach
                     <flux:button type="button"
                                  variant="filled"
                                  wire:click="addOption"
                                  class="mt-1 border">
                        Add Option
                     </flux:button>
                  </div>
                  <flux:error name="options" />
                  <flux:error name="options.*" />
               </flux:field>
               <div class="flex justify-end">
                  <flux:button type="submit" variant="primary">
                     Create Poll
                  </flux:button>
               </div>
            </form>
         </div>
      </div>
   </div>
</section>