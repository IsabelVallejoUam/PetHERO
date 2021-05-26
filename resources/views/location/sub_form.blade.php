@csrf
<div class="container" onload="initialize();">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $location->name ?? "") }}">
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Dirección</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $location->address ?? "") }}">
                </div>  

                <div class="mb-3">
                    <label for="lat" class="form-label">Latitud</label>
                    <input type="text" class="form-control" id="lat" name="lat" value="{{ old('lat', $location->lat ?? "") }}">
                </div>  

                <div class="mb-3">
                    <label for="lng" class="form-label">Longitud</label>
                    <input type="text" class="form-control" id="lng" name="lng" value="{{ old('lng', $location->lng ?? "") }}">
                </div>  
            </div>
        </div>
    </div>
    @yield('scripts')
    <div id="map_canvas">

    </div>
</div>
@section('scripts')
    
<script type="text/javascript">
    function initialize() {
        // Creating map object
        var map = new google.maps.Map(document.getElementById('map_canvas'), {
            zoom: 12,
            center: new google.maps.LatLng(-34.9206797, -57.9537638),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        // creates a draggable marker to the given coords
        var vMarker = new google.maps.Marker({
            position: new google.maps.LatLng(-34.9206797, -57.9537638),
            draggable: true
        });

        // adds a listener to the marker
        // gets the coords when drag event ends
        // then updates the input with the new coords
        google.maps.event.addListener(vMarker, 'dragend', function (evt) {
            $("#lat").val(evt.latLng.lat().toFixed(6));
            $("#lng").val(evt.latLng.lng().toFixed(6));

            map.panTo(evt.latLng);
        });

        // centers the map on markers coords
        map.setCenter(vMarker.position);

        // adds the marker on the map
        vMarker.setMap(map);
    }
</script>
@endsection