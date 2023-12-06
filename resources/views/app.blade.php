@extends('index')
@section('content')

<div class="container-fluid">
        <div class="card" style="margin: 2rem 0rem;">
            <div class="card-header">
                Venturo - Laporan penjualan tahunan per menu
            </div>
            <div class="card-body">
                <form action="{{ route('ambilData') }}" method="POST">
                    <div class="row">
                        <div class="col-2">
                            <div class="form-group">
                                @csrf
                                <select id="my-select" class="form-control" name="tahun">
                                    <option value="">Pilih Tahun</option>
                                    <option value="2021" @selected($tahun == 2021)>2021</option>
                                    <option value="2022" @selected($tahun == 2022)>2022</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-4">
                            <button type="submit" class="btn btn-primary">
                                Tampilkan
                            </button>
                                @isset($data)
                                <a href="http://tes-web.landa.id/intermediate/menu" target="_blank" rel="Array Menu" class="btn btn-secondary">
                                    Json Menu
                                </a>
                                <a href="{{ url('http://tes-web.landa.id/intermediate/transaksi?tahun=' . $tahun )}}" target="_blank" rel="Array Transaksi" class="btn btn-secondary">
                                    Json Transaksi
                                </a>
                            @endisset
                        </div>

                    </div>
                </form>
                <hr>

                @isset($data)
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" style="margin: 0;">
                        <thead>
                            <tr class="table-dark">
                                <th rowspan="2" style="text-align:center;vertical-align: middle;width: 250px;">Menu</th>
                                <th colspan="12" style="text-align: center;">Periode Pada {{ $tahun }}
                                </th>
                                <th rowspan="2" style="text-align:center;vertical-align: middle;width:75px">Total</th>
                            </tr>
                            <tr class="table-dark">
                                <th style="text-align: center;width: 75px;">Jan</th>
                                <th style="text-align: center;width: 75px;">Feb</th>
                                <th style="text-align: center;width: 75px;">Mar</th>
                                <th style="text-align: center;width: 75px;">Apr</th>
                                <th style="text-align: center;width: 75px;">Mei</th>
                                <th style="text-align: center;width: 75px;">Jun</th>
                                <th style="text-align: center;width: 75px;">Jul</th>
                                <th style="text-align: center;width: 75px;">Ags</th>
                                <th style="text-align: center;width: 75px;">Sep</th>
                                <th style="text-align: center;width: 75px;">Okt</th>
                                <th style="text-align: center;width: 75px;">Nov</th>
                                <th style="text-align: center;width: 75px;">Des</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="table-secondary" id="kategori" colspan="14"><b>Makanan</b></td>
                            </tr>
                            
                            <!-- Menambahkan Komponen Row Makanan -->
                            @include('components.makanan')

                            <tr>
                                <td class="table-secondary" id="kategori" colspan="14"><b>Minuman</b></td>
                            </tr>

                            <!-- Menambahkan Komponen Row Minuman -->
                            @include('components.minuman')
                           
                            <tr class="table-dark">
                                <td><b>Total</b></td>

                                <!-- Looping untuk mengambil nilai bulan -->
                                @for ($i = 1; $i <= 12; $i++)
                                    <td style="text-align: right;">
                                        @if(isset($jumlah[$i]) && $jumlah[$i] > 0)
                                            <b>{{ number_format($jumlah[$i], 0, ',' , '.') }}</b>
                                        @else
                                            {{-- Tampilkan string kosong jika tidak ada transaksi pada bulan tertentu --}}
                                            
                                        @endif
                                    </td>
                                @endfor

                                <!-- Hasil Total keseluruhan -->
                                <td style="text-align: right;">
                                    <b>{{ number_format($nilai, 0, ',' , '.') }}</b>
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
                @endisset
                
            </div>

        </div>
    </div>

@endsection
