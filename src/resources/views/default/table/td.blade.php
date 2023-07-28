@php
use Illuminate\Support\Str;
@endphp
@if(is_bool($data) && method_exists($model, 'icon'))
    <td class="align-middle @if($style) {{ $style }} @endif" rel="{{ $model->id }}">{!! $model->icon($col) !!}</td>
@else
    <td class="@if($style) {{ $style }} @endif @if($center) align-center @endif" @if($color) style="color:{{ $data }};font-weight:bold;" @endif>
        @if($icon)<i class="link-icon {{ $icon }} mr-1"></i>@endif
        @if($data instanceof DateTimeInterface)
            @if($dateformat)
                {!! $data->format($dateformat) !!}
            @else
                {!! $data->format('d.m.Y') !!}
            @endif
        @else
            @if($link)
                <a href="{{ $link }}" @if($target) target="{{ $target }}"@endif>
            @endif
            @if($short && $short > 0)
                {{ $data ? Str::limit(__($data), $short) : '' }}
            @else
                 {!! $data ?? '<br>' !!}
                @if($currency)
                    <span class="ms-1">{{ $currency }}</span>
                @endif
            @endif
            @if($link)</a>@endif
        @endif
    </td>
@endif

