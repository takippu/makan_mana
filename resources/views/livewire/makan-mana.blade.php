<div class="text-center">
    <div>
        <ul class="steps">
            <li class="step {{ $currentStep === 1 ? 'step-primary' : '' }}" 
                wire:click="setStep(1)" style="cursor: pointer;">Get your location</li>
            <li class="step {{ $currentStep === 2 ? 'step-primary' : '' }}" 
                wire:click="{{ $stepFinished['step1'] == 0 ? '' : 'setStep(2)'}}" 
                style="{{ $stepFinished['step1'] == 0 ? 'cursor: not-allowed; opacity: 0.5;' : 'cursor: pointer;' }}">
                Set your filters
            </li>
        </ul>
    </div>

    {{-- Step 1 Content --}}
    @if ($currentStep === 1)
        <div id="step1-content">
            {{-- <input type="text" wire:model.live="title" placeholder="Enter title..." class="text-center" /> --}}

            {{-- <h3 class="text-center">Permission: {{ $locationPermission }}</h3> --}}
            <p class="text-center">{{ $locationName }}</p>

            <button wire:ignore id="getLocationButton" class="mx-auto">Get My Location</button>
        </div>
    @endif

    {{-- Step 2 Content --}}
    @if ($currentStep === 2)
        <div id="step2-content">
            <h3 class="text-center">Filters</h3>
            <p class="text-center">Content for setting filters will go here.</p>
        </div>
    @endif
</div>
<script>
    // Get location on button click
    document.getElementById('getLocationButton').addEventListener('click', () => {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(async (position) => {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;

                console.log(`Latitude: ${lat}, Longitude: ${lng}`);

                // Reverse Geocoding to get the location name
                const locationName = await getLocationName(lat, lng);
                console.log('Location Name:', locationName);

                // Send location name to Livewire component
                @this.set('locationName', locationName);
                @this.set('locationPermission', 1);
                @this.set('stepFinished.step1', 1);
                
            }, (error) => {
                console.error('Error getting location:', error);
                @this.set('locationName', null);
                @this.set('locationPermission', 0);
                alert('Please allow location access.');
            });
        } else {
            alert('Geolocation is not supported by your browser.');
        }
    });

    // Fetch location name using Google Maps API
    async function getLocationName(lat, lng) {
        const apiKey = 'AIzaSyAB8bmYj1yV_19ZEIY1amyzxbBM9S61h7A';
        const url = `https://maps.googleapis.com/maps/api/geocode/json?latlng=${lat},${lng}&key=${apiKey}`;

        try {
            const response = await fetch(url);
            const data = await response.json();

            if (data.status === 'OK' && data.results.length > 0) {
                return data.results[0].formatted_address;
            } else {
                throw new Error('No location found');
            }
        } catch (error) {
            console.error('Geocoding API Error:', error);
            return 'Location not found';
        }
    }
</script>
