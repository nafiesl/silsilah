@extends('layouts.app')

@section('content')
@if (request('action') == 'delete' && $user)
    @can('delete', $user)
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                @include('users.partials.delete_confirmation')
            </div>
        </div>
    @endcan
@else
    <div class="pull-right">
        {{ link_to_route('users.show', __('app.show_profile').' '.$user->name, [$user->id], ['class' => 'btn btn-default']) }}
    </div>
    <h2 class="page-header">
        {{ __('user.edit') }} {{ $user->profileLink() }}
    </h2>
    <div class="row">
        <div class="col-md-2">@include('users.partials.edit_nav_tabs')</div>
        <div class="col-md-10">
            <div class="row">
                {{ Form::model($user, ['route' => ['users.update', $user->id], 'method' =>'patch', 'autocomplete' => 'off']) }}
                <div class="col-md-6">
                    @includeWhen(request('tab') == null || !in_array(request('tab'), $validTabs), 'users.partials.edit_profile')
                    @includeWhen(request('tab') == 'death', 'users.partials.edit_death')
                    @includeWhen(request('tab') == 'contact_address', 'users.partials.edit_contact_address')
                    @includeWhen(request('tab') == 'login_account', 'users.partials.edit_login_account')
                    <div class="text-right">
                        {{ Form::submit(__('app.update'), ['class' => 'btn btn-primary']) }}
                        {{ link_to_route('users.show', __('app.cancel'), [$user->id], ['class' => 'btn btn-default']) }}
                    </div>
                </div>
                {{ Form::close() }}
                <div class="col-md-6">
                    @includeWhen(request('tab') == null || !in_array(request('tab'), $validTabs), 'users.partials.update_photo')
                    @if (request('tab') == 'death')
                        <div id="mapid"></div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif
@endsection

@section('ext_css')
<link href="{{ asset('css/plugins/jquery.datetimepicker.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/plugins/select2.min.css') }}">

@if (request('tab') == 'death')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
      integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
      crossorigin=""/>

    <style>
        #mapid { height: 300px; }
    </style>
@endif
@endsection

@section('script')
<script src="{{ asset('js/plugins/jquery.datetimepicker.js') }}"></script>
<script src="{{ asset('js/plugins/select2.min.js') }}"></script>
@if (request('tab') == 'death')
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
      integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
      crossorigin=""></script>
@endif

<script>
    (function() {
        $('select').select2();
        $('#dob,#dod').datetimepicker({
            timepicker:false,
            format:'Y-m-d',
            closeOnDateSelect: true,
            scrollInput: false
        });
    })();

    @if (request('tab') == 'death')
        var mapCenter = [{{ $mapCenterLatitude }}, {{ $mapCenterLongitude }}];
        var map = L.map('mapid').setView(mapCenter, {{ $mapZoomLevel }});

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
    @endif
</script>
@endsection
