@if (!empty(config('app.recaptcha.site_key')))
<div>
    <input type="hidden" name="g-recaptcha-response">
    <script src="https://www.google.com/recaptcha/api.js?render={{ config('app.recaptcha.site_key') }}"></script>
    <script>
    let siteKey = "{{ config('app.recaptcha.site_key') }}"
    grecaptcha.ready(function() {
        grecaptcha.execute(siteKey, {action: 'login'})
            .then(function (token) {
                document.querySelector('input[name=g-recaptcha-response]').value = token
            })
    })  
    </script> 
</div>
@endif