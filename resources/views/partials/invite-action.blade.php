<div class="bg-indigo-600 text-white rounded shadow-xl py-5 px-5 w-full " x-data="{ welcomeMessageShow: true }"
    x-show="welcomeMessageShow" x-transition:enter="transition-all ease duration-500 transform"
    x-transition:enter-start="opacity-0 scale-110" x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition-all ease duration-500 transform" x-transition:leave-end="opacity-0 scale-90">
    <div class="flex flex-wrap -mx-3 items-center">
        <div class="w-1/4 px-3 text-center hidden md:block">
            <div class="p-5 xl:px-8 md:py-5">

            </div>
        </div>
        <div class="w-full sm:w-1/2 md:w-2/4 px-3 text-left">
            <div class="p-5 xl:px-8 md:py-5">
                <h3 class="text-2xl">Welcome, {{ auth()->user()->name }} !</h3>
                <h5 class="text-xl mb-3">Help Us Save More Lives through Referrals!</h5>
        <p class="text-sm text-indigo-200">We invite you to be a hero beyond donations. Spread the word by referring friends and family to join our portal. For every successful referral, both you and your referred friend will receive special recognition and contribute to our mission of building a strong, supportive community.</p>

            </div>
        </div>


        <div class="w-full sm:w-1/2 md:w-1/4 px-3 text-center">
            <div class="p-5 xl:px-8 md:py-5">
                <button
                    class="block w-full py-2 px-4 rounded text-indigo-600 bg-gray-200 hover:bg-white hover:text-gray-900 focus:outline-none transition duration-150 ease-in-out mb-3"
                    onclick="shareLink('{{ route('web.refer', ['code' => auth()->user()->referral_code]) }}')">
                    <i class="fa fa-share"></i> Share Link
                </button>

                <!-- Copy Button -->
                <button onclick="copyLink('{{ route('web.refer', ['code' => auth()->user()->referral_code]) }}')"
                    class="w-full py-2 px-4 rounded text-white bg-indigo-900 hover:bg-gray-900 focus:outline-none transition duration-150 ease-in-out">
                    <i class="fa fa-copy"></i> Copy Link
                </button>
            </div>
        </div>
    </div>
</div>




<script>
    function shareLink(link) {
        if (navigator.share) {
            navigator.share({
                title: 'Check out this link!',
                url: link
            }).then(() => {
                console.log('Link shared successfully');
            }).catch((error) => {
                console.error('Error sharing link:', error);
            });
        } else {
            console.log('Web Share API not supported');
        }
    }

    function copyLink(link) {
        const textArea = document.createElement('textarea');
        textArea.value = link;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand('copy');
        document.body.removeChild(textArea);

        console.log('Link copied to clipboard');
    }
</script>
