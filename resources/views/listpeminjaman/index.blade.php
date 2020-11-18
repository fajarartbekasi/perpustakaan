@extends('layouts.app')

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                Daftar peminjaman buku anda
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
                    <th>Denda</th>
                </tr>
            </thead>
            <tbody>
                @foreach($borrowings as $borrowing)
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
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection