@component('mail::message')
    # Dear {{ Auth::user()->name }},

    {!! $request !!}

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
