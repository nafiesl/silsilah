<div class="row">
    <div class="col-md-6">{!! FormField::text('yod', ['label' => __('user.yod'), 'placeholder' => __('app.example').' 2003']) !!}</div>
    <div class="col-md-6">{!! FormField::text('dod', ['label' => __('user.dod'), 'placeholder' => __('app.example').' 2003-10-17']) !!}</div>
</div>
{!! FormField::text('cemetery_location_name', ['label' => __('user.cemetery_location_name')]) !!}
{!! FormField::text('cemetery_location_address', ['label' => __('user.cemetery_location_address')]) !!}
{!! FormField::text('cemetery_location_latitude', ['label' => __('user.cemetery_location_latitude')]) !!}
{!! FormField::text('cemetery_location_longitude', ['label' => __('user.cemetery_location_longitude')]) !!}