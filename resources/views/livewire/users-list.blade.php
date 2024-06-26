<div class="py-12 px-12">



    <div class="mt-4 me-4">
        <x-text-input id="pincode " wire:model.live.debounce.700ms="pincode" class=" mt-1 max-w-[8rem]	 " type="number"
            name="pincode" id="pincode" required autocomplete="pincode" />



        <select class="form-text form-select   mt-1" wire:model.live.debounce.700ms="group" required="required"
            autofocus="autofocus" autocomplete="blood_type">



            <option value="All">All</option>

            @foreach ($blood_types as $k)
                <option value="{{ $k }}">{{ $k }}</option>
            @endforeach



        </select>





    </div>


    <div class="grid gap-2 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-6">

        @php
            $i = 4;
        @endphp
        @foreach ($users as $user)
            <div
                class="text-sm leading-4 bg-slate-50  shadow-lg rounded-lg dark:bg-slate-50 dark:highlight-white/5 p-6">
                <div class="relative flex flex-col-reverse">

                    <div class="flex items-center space-x-4">
                        <img src="https://ui-avatars.com/api/?name={{ $user->name }}" alt=""
                            class="flex-none w-14 h-14 rounded-full object-cover" loading="lazy" decoding="async">
                        <div class="flex-auto">
                            <div class="text-base text-slate-900 font-semibold dark:text-slate-300"><a
                                    tabindex="0"><span class="absolute inset-0"></span>{{ $user->name }}</a></div>
                            <div class="mt-0.5"> <span
                                    class="text-red-600  p-1 rounded">{{ $user->blood_type->code ?? $user->id }}ve
                                </span> | <span>{{ $user->city }}</span></div>

                        </div>

                    </div>

                    <span
                        class="absolute -bottom-1 left-10 transform -translate-y-1/2 w-4 h-4 @if ($user->last_donated_at == null) bg-yellow-400 @elseif($user->last_donated_at->addMonths(3) < now()) bg-green-400 @else bg-red-400 @endif border-2 border-white dark:border-gray-800 rounded-full"></span>

                </div>


                <div class="flex p-4 text-center">


                    <a href="{{ route('call', [$user->referral_code]) }}"
                        class="middle none center mr-3 flex items-center justify-center rounded-lg border border-red-500 hover:bg-red-500  p-3 font-sans text-xs font-bold uppercase text-red-500 hover:text-gray-50 transition-all hover:opacity-75 focus:ring focus:ring-red-200 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                        data-ripple-dark="true">
                        <i class="fas fa-phone text-lg leading-none"></i>
                    </a>

                    <a href="{{ route('whatsapp', [$user->referral_code]) }}"
                        class="middle none center mr-3 flex items-center justify-center rounded-lg border border-green-500 hover:bg-green-500  p-3 font-sans text-xs font-bold uppercase text-green-500 hover:text-gray-50 transition-all hover:opacity-75 focus:ring focus:ring-green-200 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                        data-ripple-dark="true">
                        <i class="fa-brands fa-whatsapp text-lg leading-none"></i>
                    </a>

                    @if (1 > 2)
                        <a href="#"
                            class="users-contact-btn ml-2  bg-red-400  hover:bg-primary-600 focus:bg-primary-600 active:bg-primary-700 ">Contact
                        </a>
                    @endif

                </div>

            </div>


            @if ($loop->iteration % 4 == 0 and $loop->iteration % 8 != 0)
                <div
                    class="text-sm leading-4 bg-slate-50  shadow-lg rounded-lg dark:bg-slate-50 dark:highlight-white/5 ">



                    <img src="https://www.analyticsinsight.net/wp-content/uploads/2021/09/Cryptocurrencies-2.jpg"
                        style="height:100%" class="rounded-lg">


                </div>

                @php

                    $i = $i + 5;
                @endphp
            @endif
        @endforeach
    </div>







</div>
