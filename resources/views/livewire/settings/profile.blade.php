<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;
use App\Traits\HasNotifications;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

new class extends Component 
{
    use HasNotifications, WithFileUploads;

    public string $name = '';
    public string $email = '';
    public  $user;
    public $profile_image;
    public $temp_profile_image;

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->user = Auth::user();
        
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;

        if ($this->user) {
            $this->temp_profile_image = $this->user->profile_image ? Storage::url($this->user->profile_image) : null;
        }
    }

    public function saveImage()
    {
        $validated = $this->validate([
            'profile_image' => 'nullable|image|max:1024',
        ]);

        try {
            $data = [];
            // Handle profile_image upload only if a new one is selected
            if ($this->profile_image) {
                // Delete old profile_image if exists
                if ($this->user && $this->user->profile_image) {
                    Storage::disk('public')->delete($this->user->profile_image);
                }
                $profile_imageName = "profile_image-" . time() . '.' . $this->profile_image->getClientOriginalExtension();
                $data['profile_image'] = $this->profile_image->storeAs('user', $profile_imageName, 'public');
            }

            if ($this->user) {
                $this->user->update($data);
            } else {
                User::create($data);
            }

            $this->succsessNotify("profile_image settings saved successfully!");
            // return redirect()->route('website.index');
        } catch (\Throwable $th) {
            $this->unsuccsessNotify("Failed to save profile_image settings: " . $th->getMessage());
        }
    }
    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($user->id)
            ],
        ]);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch('profile-updated', name: $user->name);
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function resendVerificationNotification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
}; ?>

<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Profile')" :subheading="__('Update your name and email address')">

        <form wire:submit="updateProfileInformation" class="my-6 w-full space-y-6 border p-4 shadow-lg rounded-lg bg-white dark:bg-gray-800">
            <flux:input wire:model="name" :label="__('Name')" type="text" required autofocus autocomplete="name" />

            <div>
                <flux:input wire:model="email" :label="__('Email')" type="email" required autocomplete="email" />

                @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail &&! auth()->user()->hasVerifiedEmail())
                    <div>
                        <flux:text class="mt-4">
                            {{ __('Your email address is unverified.') }}

                            <flux:link class="text-sm cursor-pointer" wire:click.prevent="resendVerificationNotification">
                                {{ __('Click here to re-send the verification email.') }}
                            </flux:link>
                        </flux:text>

                        @if (session('status') === 'verification-link-sent')
                            <flux:text class="mt-2 font-medium !dark:text-green-400 !text-green-600">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </flux:text>
                        @endif
                    </div>
                @endif
            </div>

            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full">{{ __('Save') }}</flux:button>
                </div>

                <x-action-message class="me-3" on="profile-updated">
                    {{ __('Saved.') }}
                </x-action-message>
            </div>
        </form>

        <form wire:submit.prevent="saveImage" class="border p-4 shadow-lg rounded-lg bg-white dark:bg-gray-800">
            <div class="space-y-6">
                <!-- Logo -->
                <div>
                    <label for="profile_image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Change Profile Pucture</label>
                    <small>Image maximum size 1mb</small>
                    <input type="file" wire:model="profile_image" id="profile_image"
                        class="mt-1 block w-full text-sm text-gray-500 file:bg-indigo-50 file:text-indigo-700 dark:file:bg-zinc-700 dark:file:text-zinc-300">
                    @error('profile_image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    <div class="mt-2">
                        @if($profile_image)
                        <img src="{{ $profile_image->temporaryUrl() }}" class="h-32 w-auto">
                        @elseif($temp_profile_image)
                        <img src="{{ $temp_profile_image }}" class="h-32 w-auto">
                        @endif
                    </div>
                </div>


                <!-- Save Button -->
                <div class="flex justify-end">
                    <button type="submit" wire:loading.attr="disabled"
                        class="px-4 py-2 bg-black text-white rounded-md hover:bg-indigo-700 ">Save
                        Picture</button>
                </div>
            </div>
        </form>

        <livewire:settings.delete-user-form />
    </x-settings.layout>
</section>
