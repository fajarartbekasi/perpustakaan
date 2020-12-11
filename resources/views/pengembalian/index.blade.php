@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">
            Data Pengembalian Buku
        </li>
    </ol>
</nav>

<div class="card card-body border-0">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Buku</th>
                <th>Nama Siswa</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Durasi Peminjaman</th>
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
                            $datetime2 = strtotime($date) ;
                            $datenow = strtotime($borrowing->tgl_pinjam);
                            $durasi = ($datenow - $datetime2) / 86400 ;
                            $durasi2 = ($durasi) + 7;
                        ?>
                        @if ($durasi < -7 ) Durasi Habis / {{ number_format($durasi2) }} Hari
                            @else
                            <?php $durasi1 = abs($durasi) ?> {{ number_format($durasi1) }} Hari
                        @endif
                    </td>
                    <td>
                        <a href="{{route('pengembalian.create', $borrowing->id)}}" class="btn btn-outline-info btn-sm">Kembalikan Buku</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Maaf data Pengembalian belum tersedia</td>
                </tr>
            @endforelse
        </tbody>

    </table>
</div>

@endsection