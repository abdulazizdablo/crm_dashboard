@component('mail::message')
# {{ $user_name }}
  
Project has beem assigned please click the linke below for further details  
@component('mail::button', ['url' =>route('projects.show',$project)])
Visit Our Website
@endcomponent
  
Thanks,

{{ config('app.name') }}
@endcomponent