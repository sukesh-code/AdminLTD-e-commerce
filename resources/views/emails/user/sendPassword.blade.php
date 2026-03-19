<x-mail::message>

# Hello {{ $user->name }}

Your account has been created successfully.

**Email:** {{ $user->email }}

**Password:** {{ $password }}

<x-mail::button :url="url('/login')">
Login Now
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}

</x-mail::message>
