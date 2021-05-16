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
