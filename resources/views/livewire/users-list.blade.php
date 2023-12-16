<div class="py-12 px-12">



    <div class="mt-4 me-4">
        <x-text-input id="pincode " wire:model.live.debounce.700ms="pincode" class=" mt-1 max-w-[8rem]	 " type="number" name="pincode"
            id="pincode" required autocomplete="pincode" />



        <select class="form-text form-select   mt-1" wire:model.live.debounce.700ms="group" required="required"
            autofocus="autofocus" autocomplete="blood_type">



            <option value="All">All</option>

            @foreach ($blood_types as $k)
                <option value="{{ $k }}">{{ $k }}</option>
            @endforeach



        </select>





    </div>


    <div class="grid gap-2 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-6">
        @foreach ($users as $user)
            <div
                class="text-sm leading-4 bg-slate-50  shadow-lg rounded-lg dark:bg-slate-50 dark:highlight-white/5 p-6">
                <div class="relative flex flex-col-reverse">

                    <div class="flex items-center space-x-4"><img
                            src="https://ui-avatars.com/api/?name={{ $user->name }}" alt=""
                            class="flex-none w-14 h-14 rounded-full object-cover" loading="lazy" decoding="async">
                        <div class="flex-auto">
                            <div class="text-base text-slate-900 font-semibold dark:text-slate-300"><a
                                    href="https://twitter.com/ryanflorence/status/1187951799442886656"
                                    tabindex="0"><span class="absolute inset-0"></span>{{ $user->name }}</a></div>
                            <div class="mt-0.5"> <span class="text-red-600  p-1 rounded">{{ $user->blood_type->code ?? $user->id }}ve </span>  |   <span>{{$user->city}}</span></div>

                        </div>



                    </div>



                </div>

                <div class="flex p-4">
                    <a href="#"
                        class="inline-block rounded bg-blue-400 px-6 pb-2 pt-2.5 text-xs

                            font-medium
                            uppercase
                            leading-normal
                            text-white
                            shadow-[0_4px_9px_-4px_#3b71ca]
                            transition
                            duration-150
                            ease-in-out
                            hover:bg-blue-600
                            hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)]
                            focus:bg-blue-600
                            focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)]
                            focus:outline-none focus:ring-0
                            active:bg-blue-700
                            active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)]
                            dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)]
                            dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]
                            dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]
                            dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]
                            ">Follow</a>
                    <a href="#"
                        class="ml-2 inline-block rounded bg-red-400 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]">Contact
                    </a>
                </div>
            </div>
        @endforeach
    </div>







</div>
