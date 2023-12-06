@foreach ($menu as $item)
    @if ($item->kategori == 'minuman')
        <tr>
            <td>{{ $item->menu }}</td>
            @for ($i = 1; $i <= 12; $i++)
                <td style="text-align: right;">
                    @if(isset($result[$item->menu][$i]) && $result[$item->menu][$i] > 0)
                        {{ number_format($result[$item->menu][$i], 0, ',', '.') }}
                    @else
                        {{-- Tampilkan string kosong jika tidak ada transaksi pada bulan tertentu --}}
                        
                    @endif
                </td>
            @endfor

            <td class="text-end">
                   <b>{{ number_format($jumlahmenu[$item->menu], 0, ',', '.') }}</b> 
            </td>
        </tr>
    @endif
@endforeach
                                
                           