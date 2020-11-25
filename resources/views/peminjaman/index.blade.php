@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">
            Data Peminjaman Buku
        </li>
    </ol>
</nav>

<div class="card card-body border-0">
    <form action="{{route('rekap-laporan.periode')}}" class="mb-3" method="GET">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Dari Tanggal</label>
                    <input type="date" name="tgl_awal" id="" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Dari Tanggal</label>
                    <input type="date" name="tgl_akhir" id="" class="form-control">
                </div>
            </div>
            <div class="col-md-12">
                <div class="d-flex">
                    <div class="mr-auto">
                        <a href="{{route('rekap-laporan.peminjaman')}}" class="btn btn-secondary">Rekap Seluruh Laporan</a>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-info">Cari laporan</button>
                    </div>
                </div>

            </div>
        </div>
    </form>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Buku</th>
                <th>Nama Siswa</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Durasi Peminjaman</th>
                <th>Denda</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($borrowings as $borrowing)
                <tr>
                    <td>{{$borrowing->book->name}}</td>
                    <td>{{$borrowing->user->name}}</td>
                    <td>{{$borrowing->tgl_pinjam}}</td>
                    <td>{{$borrowing->tgl_kembali}}</td>
                    <td>
                        <?php
                            $datetime2 = strtotime($borrowing->tgl_kembali) ;
                            $datenow = strtotime($borrowing->tgl_pinjam);
                            $durasi = ($datenow - $datetime2) / 86400 ;
                            $durasi2 = ($durasi) + 7;
                        ?>
                        @if ($durasi < -7 ) Durasi Habis / {{ $durasi2 }} Hari
                            @else
                            <?php $durasi1 = abs($durasi) ?> {{ $durasi1 }} Hari
                        @endif
                    </td>
                    <td>
                        @if ($durasi < -12) <?php $denda = 5000 ; ?> {{ $denda }}
                            @elseif ($durasi < -7)
                            <?php $denda = abs($durasi2) * 1000 ; ?> {{ $denda }}
                            @else
                            0
                        @endif
                    </td>
                    <td>
                        <form action="{{route('borrowings.destroy', $borrowing->id)}}" method="post" type="hidden">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger btn-sm">
                                Kembalikan Buku
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Maaf data peminjaman belum tersedia</td>
                </tr>
            @endforelse
        </tbody>

    </table>
</div>

@endsection