<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @php

        $users = \App\Models\User::all();
    @endphp

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid grid-cols-4 gap-4">






                @for ($i = 1; $i <= 10; $i++)
                    <div class="text-sm leading-4 bg-slate-50 rounded-lg dark:bg-slate-800 dark:highlight-white/5 p-6">
                        <div class="relative flex flex-col-reverse">

                            <div class="flex items-center space-x-4"><img src="https://ui-avatars.com/api/?name=John+Doe"
                                    alt="" class="flex-none w-14 h-14 rounded-full object-cover" loading="lazy"
                                    decoding="async">
                                <div class="flex-auto">
                                    <div class="text-base text-slate-900 font-semibold dark:text-slate-300"><a
                                            href="https://twitter.com/ryanflorence/status/1187951799442886656"
                                            tabindex="0"><span class="absolute inset-0"></span>Ryan Florence</a></div>
                                    <div class="mt-0.5">AB+ve</div>
                                </div>



                            </div>



                        </div>

                        <div class="flex p-4">
                            <a href="#"
                                class="text-slate-50 hover:text-slate-50 mr-2 bg-blue-500 p-2 rounded font-bold">Add
                                Friend</a>
                            <a href="#"
                                class="text-red-500 hover:text-red-700 p-2 rounded font-bold border">Contact
                            </a>
                        </div>
                    </div>
                @endfor
            </div>

        </div>

    </div>


</x-app-layout>
