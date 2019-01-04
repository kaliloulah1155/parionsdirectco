
@component('mail::message')
    # Message d'information client

    {{--  {!!$email !!} --}}


             {!!$msg !!}


    Merci
    {{-- {{ config('app.name') }} --}}
@endcomponent

