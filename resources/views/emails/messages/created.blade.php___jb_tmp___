@component('mail::message')
# Récupération de mot de passe

 {{-- - {{ $email}} --}}

@component('mail::panel')
  Bonjour cher utilisateur,
 <br/>
	Vous aviez demandé une réinitialisation de votre mot de passe sur le backoffice parions direct.
 <br/>
 	Veuillez cliquer sur le bouton ci-dessous.
@endcomponent

@component('mail::button', ['url' =>route('resetPassword'),'color'=>'red'])
   Récupération
@endcomponent

Merci<br>
{{-- {{ config('app.name') }} --}}
@endcomponent
