<x-mail::message>
{{-- Greeting --}}
@if (! empty($greeting))
    # {{ $greeting }}
@else
@if ($level === 'error')
# @lang('Whoops!')
@else
{{-- # @lang('Olá!') --}}
    <div style="display: flex!important; justify-content; center!important; margin-bottom: 20px">
        <img src="https://www.pacoca.x10.mx/img/pacoca-fundo.png" style="height: 200px; margin: 0 auto!important" class="img">
    </div>
</div>
@endif
@endif


@php
    $actionUrl = str_replace('http://127.0.0.1:8000', 'http://pacoca.x10.mx', $actionUrl);
    $displayableActionUrl = str_replace('http://127.0.0.1:8000', 'http://pacoca.x10.mx', $displayableActionUrl);

@endphp

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{$line}}
@endforeach

{{-- Action Button --}}
@isset($actionText)
<?php
    $color = match ($level) {
        'success', 'error' => $level,
        default => 'primary',
    };
?>
<x-mail::button :url="$actionUrl" :color="$color">
{{ $actionText }}
</x-mail::button>
@endisset



{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
@lang('Atenciosamente'),<br>
{{ config('app.name') }}
@endif

{{-- Subcopy --}}
@isset($actionText)
<x-slot:subcopy>
@lang(
    "Se você estiver com problemas para clicar no botão  \":actionText\", copie e cole o URL abaixo\n".
    'em seu navegador:',
    [
        'actionText' => $actionText,
    ]
) <span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
</x-slot:subcopy>
@endisset
</x-mail::message>
