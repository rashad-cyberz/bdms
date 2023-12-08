<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf



        {{-- Blood Types --}}


        <div>
            <x-input-label for="blood_type" :value="__('Blood Group')" />

            <x-select name="blood_type" class="block mt-1 w-full" required autofocus autocomplete="blood_type"
                :options=$blood_types  />

            <x-input-error :messages="$errors->get('blood_type')" class="mt-2" />
        </div>



        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex mt-4">
            <div class="w-30 flex items-center justify-center bg-blue-lighter  text-blue-dark">

                <x-select name="dial_code" class="block mt-1 w-full" required autofocus autocomplete="dial_code"
                    :options="['91' => '+91']" />

            </div>
            <x-text-input id="mobile" class="block mt-1 w-full" type="text" name="mobile" :value="old('mobile')"
                required autofocus autocomplete="mobile" />

        </div>


        <div class="mt-4">
            <x-input-label for="pincode" :value="__('Pin Code')" />
            <x-text-input onchange="validatePincode()" id="pincode" class="block mt-1 w-full" type="number"
                name="pincode" id="pincode" :value="old('pincode')" required autocomplete="pincode" />
            <x-input-error :messages="$errors->get('pincode')" class="mt-2" />
            <span class="mt-2 text-sm text-red-600 dark:text-red-400 space-y-1" id="pincodeError"></span>


        </div>


        <div class="mt-4" id="pincodeNameContainer" style="display: none;">
            <x-input-label for="pincode_name" :value="__('Area Name')" />
            <x-select name="pincode_name" id="pincodeName" class="block mt-1 w-full" :options="[]"></x-select>
            <x-input-error :messages="$errors->get('pincode_name')" class="mt-2" />

        </div>





        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>




    <script>
        $(document).ready(function() {
            // Trigger pincode validation on page load if a pincode is already present
            validatePincode();

            // Event listener for pincode input change
            $("#pincode").on("change", function() {
                validatePincode();
            });

            // Event listener for the "Validate Pincode" button click
            $("#validatePincode").on("click", function() {
                validatePincode();
            });

            function validatePincode() {
                var pincode = $("#pincode").val();

                $("#pincodeError").hide();
                $("#pincodeNameContainer").hide();

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
                                    var option = $("<option>").val(office.Name + '/' + office
                                        .District + '/' + office.State).text(office.Name);
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
        });
    </script>
</x-guest-layout>
