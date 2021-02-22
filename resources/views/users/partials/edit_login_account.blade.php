<div class="panel panel-default">
    <div class="panel-heading"><h3 class="panel-title">{{ __('app.login_account') }}</h3></div>
    <div class="panel-body">
        {!! FormField::email('email', ['label' => __('auth.email'), 'placeholder' => __('app.example').' nama@mail.com']) !!}
        {!! FormField::password('password', ['label' => __('auth.password'), 'placeholder' => '******', 'value' => '']) !!}
    </div>
</div>
