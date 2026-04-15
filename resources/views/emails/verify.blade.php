<!DOCTYPE html>
<html>
<head>
    <title>{{ trans('auth.verify_email') }}</title>
</head>
<body>
    <h2>{{ trans('genral.Hello') }} {{ $user->firstName }},</h2>
<p>{{ trans('auth.click_activate_account') }}:</p>
<p>{{ $verificationUrl }}</p>


    <p>{{ trans('auth.further_action') }}</p>
</body>
</html>
