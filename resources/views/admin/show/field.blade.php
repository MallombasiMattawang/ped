<tr>
    <th width="300">{{ $label }}</th>
    <th width="10">:</th>
    <td>
        @if($wrapped)
        
                @if($escape)
                    {{ $content }}&nbsp;
                @else
                    {!! $content !!}&nbsp;
                @endif
                   
        @else
            @if($escape)
                {{ $content }}
            @else
                {!! $content !!}
            @endif
        @endif
    </td>
</tr>
