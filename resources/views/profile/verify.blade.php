<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Verify Mobile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>


                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('OTP sent to your mobile ending in :maskedDigits', ['maskedDigits' => str_repeat('*', strlen($user->mobile) - 4) . substr($user->mobile, -4)]) }}
                            </p>
                        </header>



                        <form method="post" action="{{ route('mobile.do-verify') }}" class="mt-6 space-y-6">
                            @csrf

                            <div>
                                <x-input-label for="otp" :value="__('OTP')" />
                                <x-text-input id="otp" name="otp" type="text" class="mt-1 block w-full"
                                    :value="old('otp')" required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('otp')" />
                            </div>



                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Verify') }}</x-primary-button>

                                @if (session('status') === 'profile-updated')
                                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600 dark:text-gray-400">{{ __('Verified.') }}</p>
                                @endif
                            </div>
                        </form>
                    </section>

                </div>
            </div>


        </div>
    </div>
</x-app-layout>
