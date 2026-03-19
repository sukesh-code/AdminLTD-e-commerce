`<x-mail::message>
Your OTP is: **{{ $user->otp }}**

This OTP will expire in 60 second.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
