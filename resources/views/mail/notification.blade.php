<x-mail::layout>
{{-- Header --}}
<x-slot:header>
{{-- Header --}}
<x-slot:header>
<x-mail::header :url="config('app.url')">
{{ config('app.name') }}
</x-mail::header>
</x-slot:header>

{{-- Body --}}
<div style="margin-bottom: 20px; display: flex; justify-content:center;">
    <img src="https://www.pacoca.x10.mx/img/pacoca-fundo.png" style="height: 200px; margin: 0 auto!important" class="img">
</div>
<h2>{{$subject}}</h2>
<p>Olá,</p>
<p>{{$text}}</p>
<table class="action" align="center" width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td align="center">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td align="center">
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td>
                                    <a href="{{ $link1 }}" class="button button-primary">{{ $textButton }}</a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

{{-- Footer --}}
<x-slot:footer>
<x-mail::footer>
© {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
</x-mail::footer>
</x-slot:footer>
</x-mail::layout>
