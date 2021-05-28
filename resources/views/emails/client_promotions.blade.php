@component('mail::message')
# Hi {{ $customer->customer->name }}

{{ $message }}

@component('mail::button', ['url' => $url])
View Poromotion
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
