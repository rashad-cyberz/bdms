<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)"
                required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)"
                required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification"
                            class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>



        <div class="flex mt-4">
            <div class="w-30 flex items-center justify-center bg-blue-lighter  text-blue-dark">

                <x-select disabled name="dial_code" class="block mt-1 w-full" required autofocus autocomplete="dial_code">


                    <option value="91">+91</option>

                </x-select>

            </div>
            <x-text-input disabled id="mobile" class="block mt-1 w-full" type="text" name="mobile" :value="old('mobile', $user->mobile)"
                required autofocus autocomplete="mobile" />

        </div>


        <div class="mt-4">
            <x-input-label for="pincode" :value="__('Pin Code')" />
            <x-text-input  disabled onchange="validatePincode()" id="pincode" class="block mt-1 w-full" type="number"
                name="pincode" id="pincode" :value="old('pincode', $user->zip_code)" required autocomplete="pincode" />
            <x-input-error :messages="$errors->get('pincode')" class="mt-2" />
            <span class="mt-2 text-sm text-red-600 dark:text-red-400 space-y-1" id="pincodeError"></span>


        </div>


        <div class="mt-4" id="pincodeNameContainer">
            <x-input-label for="pincode_name" :value="__('Area Name')" />
            <x-select  disabled name="pincode_name" id="pincodeName" class="block mt-1 w-full" ></x-select>
            <x-input-error :messages="$errors->get('pincode_name')" class="mt-2" />

        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>



<script>
    validatePincode();
    var selectedArea = "{{$user->city}}";

    function validatePincode() {
        var pincode = $("#pincode").val();

        $("#pincodeError").hide();

        if (pincode > 0) {
            // Make an API call to validate the pincode and get pincode name
            $.ajax({
                url: `https://api.postalpincode.in/pincode/${pincode}`,
                method: "GET",
                dataType: "json",
                success: function(data) {
                    if (data[0].Status === 'Success') {
                        // Pincode is valid, show the pincode name select box
                        $("#pincodeNameContainer").show();

                        // Populate the pincode name select box with data from the API
                        var pincodeNameSelect = $("#pincodeName");
                        pincodeNameSelect.empty();

                        $.each(data[0].PostOffice, function(index, office) {



                            if(selectedArea == office.Name){
                                var option = "<option value='"+office.Name + '/' + office
                                .District + '/' + office.State+" ' selected>"+office.Name+"</option>";
                            }else{
                                var option = "<option value='"+office.Name + '/' + office
                                .District + '/' + office.State+"'>"+office.Name+"</option>";
                            }


                                 pincodeNameSelect.append(option);
                        });

                    } else {
                        // Pincode is invalid, show the error message
                        $("#pincodeError").show().text("Pincode is invalid");
                    }
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });

        }
    }
</script>
