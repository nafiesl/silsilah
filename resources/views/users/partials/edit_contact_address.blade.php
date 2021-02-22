<div class="panel panel-default">
    <div class="panel-heading"><h3 class="panel-title">{{ __('app.address') }} &amp; {{ __('app.contact') }}</h3></div>
    <div class="panel-body">
        {!! FormField::textarea('address', ['label' => __('app.address')]) !!}
        {!! FormField::text('city', ['label' => __('app.city'), 'placeholder' => __('app.example').' Jakarta']) !!}
        {!! FormField::text('phone', ['label' => __('app.phone'), 'placeholder' => __('app.example').' 081234567890']) !!}
    </div>
</div>
