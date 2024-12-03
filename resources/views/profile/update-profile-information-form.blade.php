<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" id="photo" class="hidden"
                            wire:model.live="photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-label for="photo" value="{{ __('Photo') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                          x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-secondary-button class="mt-2 me-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </x-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </x-secondary-button>
                @endif

                <x-input-error for="photo" class="mt-2" />
            </div>
        @endif


        @php
            $config = [
                "title" => "Select multiple options...",
                "liveSearch" => true,
                "liveSearchPlaceholder" => "Search...",
                "showTick" => true,
                "actionsBox" => true,
            ];
        @endphp

        {{-- Minimal --}}
        


        
        
        <!-- Cargo -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="cargo" value="{{ __('Delegación') }}" />
            <x-adminlte-select2 name="sel2Basic" fgroup-class="col-md-12">
                <option selected>Option 3</option>
            </x-adminlte-select2>
        </div>    

        <!-- Cargo -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="cargo" value="{{ __('Cargo') }}" />
            <x-input id="cargo" type="text" class="mt-1 block w-full" wire:model="state.cargo" required autocomplete="cargo" />
            <x-input-error for="nombre" class="mt-2" />
        </div>    

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="nombre" value="{{ __('Nombre') }}" />
            <x-input id="nombre" type="text" class="mt-1 block w-full" wire:model="state.nombre" required autocomplete="nombre" />
            <x-input-error for="nombre" class="mt-2" />
        </div>

        <!-- Apellito Paterno -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="apaterno" value="{{ __('Apellido Paterno') }}" />
            <x-input id="apaterno" type="text" class="mt-1 block w-full" wire:model="state.apaterno" required autocomplete="apaterno" />
            <x-input-error for="apaterno" class="mt-2" />
        </div>

        <!-- Apellido Materno -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="amaterno" value="{{ __('Apellido Materno') }}" />
            <x-input id="amaterno" type="text" class="mt-1 block w-full" wire:model="state.amaterno" required autocomplete="amaterno" />
            <x-input-error for="amaterno" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="email" value="{{ __('Email') }}" />
            <x-input id="email" type="email" class="mt-1 block w-full" wire:model="state.email" required autocomplete="username" />
            <x-input-error for="email" class="mt-2" />

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                <p class="text-sm mt-2">
                    {{ __('Your email address is unverified.') }}

                    <button type="button" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" wire:click.prevent="sendEmailVerification">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if ($this->verificationLinkSent)
                    <p class="mt-2 font-medium text-sm text-green-600">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            @endif
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>
