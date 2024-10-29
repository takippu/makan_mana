<h1>Nearby Restaurants</h1>
<div id="map" class="mx-auto"></div>

<script>
    // Initialize the map
    function initMap() {
        // Try to get the user's current location
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                const userLocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                };

                // Create the map centered on the user's location
                const map = new google.maps.Map(document.getElementById("map"), {
                    center: userLocation,
                    zoom: 15,
                });

                // Create a marker for the user's location
                new google.maps.Marker({
                    position: userLocation,
                    map: map,
                    title: "You are here",
                });

                // Search for nearby restaurants using Places API
                const service = new google.maps.places.PlacesService(map);
                service.nearbySearch(
                    {
                        location: userLocation,
                        radius: 1500, // Search within 1.5 km radius
                        type: ["restaurant"],
                    },
                    function (results, status) {
                        if (status === google.maps.places.PlacesServiceStatus.OK) {
                            results.forEach((place) => {
                                // Create a marker for each restaurant found
                                new google.maps.Marker({
                                    position: place.geometry.location,
                                    map: map,
                                    title: place.name,
                                });
                            });
                        } else {
                            console.error("Error fetching places: ", status);
                        }
                    }
                );
            });
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    }

    // Initialize the map when the page loads
    window.onload = initMap;
</script>