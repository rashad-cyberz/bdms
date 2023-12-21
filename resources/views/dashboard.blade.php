<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

            </div>






            @include('partials.invite-action')




            @php

                $friends = \App\Models\User::where('referred_by', auth()->user()->id)->get();
            @endphp






            @if ($friends->count() > 0)
                <div class=" py-5 px-5 w-full ">



                    <h1>You Invited </h1>
                    <div class="rounded-lg border border-gray-200">
                        <div class="overflow-x-auto rounded-t-lg">
                            <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                                <thead class="text-right">
                                    <tr>
                                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Name</th>
                                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Blood</th>
                                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Area</th>
                                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">State</th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-gray-200 text-right">



                                    @foreach ($friends as $friend)
                                        <tr>
                                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ $friend->name}}
                                            </td>
                                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $friend->blood_type->code.'ve'}}</td>
                                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $friend->city}}</td>
                                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $friend->state}}</td>
                                        </tr>
                                    @endforeach



                                </tbody>
                            </table>
                        </div>


                    </div>

                </div>

            @endif

        </div>



    </div>

</x-app-layout>
