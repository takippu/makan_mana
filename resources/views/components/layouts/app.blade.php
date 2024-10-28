<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
        <title>{{ $title ?? 'Error' }} | makan_mana?</title>
        <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.13/dist/full.min.css" rel="stylesheet" type="text/css" />
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAB8bmYj1yV_19ZEIY1amyzxbBM9S61h7A&libraries=places"></script>
        <style>
            #map {
                height: 100vh;
                width: 100%;
            }
        </style>
    </head>
    <body>
        @include('livewire.nav.topNav')
        {{ $slot }}
        @include('livewire.nav.bottomNav')

    </body>
</html>