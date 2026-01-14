<x-mail::message>
# Todo Créé

<x-mail::panel>
Votre Todo a été créé !
</x-mail::panel>

<x-mail::button :url="$url">
Accéder au Todo
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
