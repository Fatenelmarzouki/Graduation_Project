@component('mail::message')
Your message body.
{{$child_code["child_code"]}}
@component('mail::button', ['url' => "link"])
Verify
@endcomponent
Thanks,<br>
jop
@endcomponent
