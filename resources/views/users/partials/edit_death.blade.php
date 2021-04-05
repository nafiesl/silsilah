<div class="row">
    <div class="col-md-6">{!! FormField::text('yod', ['label' => __('user.yod'), 'placeholder' => __('app.example').' 2003']) !!}</div>
    <div class="col-md-6">{!! FormField::text('dod', ['label' => __('user.dod'), 'placeholder' => __('app.example').' 2003-10-17']) !!}</div>
</div>

<fieldset>
    <legend>{{ __('user.cemetery_location') }}</legend>
    {!! FormField::text('cemetery_location_name', ['label' => __('address.location_name'), 'value' => old('cemetery_location_name', $user->getMetadata('cemetery_location_name'))]) !!}
    {!! FormField::textarea('cemetery_location_address', ['label' => __('address.address'), 'value' => old('cemetery_location_address', $user->getMetadata('cemetery_location_address'))]) !!}
    <div class="row">
        <div class="col-md-6">{!! FormField::text('cemetery_location_latitude', ['label' => __('address.latitude'), 'value' => old('cemetery_location_latitude', $user->getMetadata('cemetery_location_latitude'))]) !!}</div>
        <div class="col-md-6">{!! FormField::text('cemetery_location_longitude', ['label' => __('address.longitude'), 'value' => old('cemetery_location_longitude', $user->getMetadata('cemetery_location_longitude'))]) !!}</div>
    </div>
</fieldset>
<div id="mapid"></div>

@section('ext_css')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
  integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
  crossorigin=""/>

<style>
    #mapid { height: 300px; }
</style>
@endsection

@section('script')
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
  integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
  crossorigin=""></script>
<script>
    var mapCenter = [{{ $user->getMetadata('cemetery_location_latitude') }}, {{ $user->getMetadata('cemetery_location_longitude') }}];
    var map = L.map('mapid').setView(mapCenter, 18);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var marker = L.marker(mapCenter).addTo(map);
    function updateMarker(lat, lng) {
        marker
        .setLatLng([lat, lng])
        .bindPopup("Your location :  " + marker.getLatLng().toString())
        .openPopup();
        return false;
    };

    map.on('click', function(e) {
        let latitude = e.latlng.lat.toString().substring(0, 15);
        let longitude = e.latlng.lng.toString().substring(0, 15);
        $('#cemetery_location_latitude').val(latitude);
        $('#cemetery_location_longitude').val(longitude);
        updateMarker(latitude, longitude);
    });

    var updateMarkerByInputs = function() {
        return updateMarker( $('#cemetery_location_latitude').val() , $('#cemetery_location_longitude').val());
    }
    $('#cemetery_location_latitude').on('input', updateMarkerByInputs);
    $('#cemetery_location_longitude').on('input', updateMarkerByInputs);
</script>
@endsection
