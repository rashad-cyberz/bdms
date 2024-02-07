@if (env('APP_ENV') == 'local')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@else
    <link rel="stylesheet" href="{{ asset('build/assets/app-01c0d872.css') }}" />


    <script src="{{ asset('build/assets/app-b1941ff8.js') }}"></script>
@endif
