<x-mail::message>
Welcome : {{ $name }}

You create {{ $product->name_en }} at {{ $product->created_at->format('d M Y') }}
This mail is sent by super admin .


<x-mail::button :url="$url">
Show Product
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
