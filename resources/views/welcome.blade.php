<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Find Near By  Donors') }}


            @auth
                <x-btn-link class="float-right " href="{{ route('donors.add') }}">

                    <i class="fa-solid fa-plus"></i> Add Donor
                </x-btn-link>

            </h2>

        @endauth






    </x-slot>






    @livewire('users-list')
















    </div>







    <x-slot name="scripts">

    </x-slot>





</x-app-layout>
